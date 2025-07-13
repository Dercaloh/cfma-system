<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ImportUsuariosRequest;
use App\Services\Usuarios\ImportadorUsuariosService;
use App\Models\Locations\{Branch, Department, Location};
use App\Models\Programs\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Log, Storage};
use Maatwebsite\Excel\Validators\ValidationException;

/**
 * Controlador para la importación masiva de usuarios.
 *
 * Cumple con normativas legales y técnicas:
 * - Ley 1581 de 2012 (Protección de datos personales)
 * - ISO 27001 (Seguridad de la información)
 * - Resolución 1122 de 2023 (Accesibilidad web)
 * - Ley 1712 de 2014 (Transparencia y acceso a la información)
 *
 * Clasificación de información:
 * 🟢 Pública | 🟡 Clasificada | 🔴 Reservada
 */
class UsuarioImportController extends Controller
{
    protected ImportadorUsuariosService $importService;

    public function __construct(ImportadorUsuariosService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * Mostrar formulario de importación de usuarios.
     */
    public function index()
    {
        try {
            $branches = Branch::active()->orderBy('name')->get();
            $departments = Department::active()->orderBy('name')->get();
            $locations = Location::active()->orderBy('name')->get();
            $positions = Position::active()->orderBy('name')->get();

            activity('user_import')->causedBy(Auth::user())
                ->withProperties([
                    'action' => 'view_import_form',
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'classification' => 'classified'
                ])->log('Acceso al formulario de importación');

            return view('modules.importar.index', compact(
                'branches', 'departments', 'locations', 'positions'
            ));
        } catch (\Exception $e) {
            Log::error('Error cargando formulario de importación', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'classification' => 'reserved'
            ]);

            return redirect()->back()
                ->with('error', 'Error al cargar el formulario. Contacte al administrador.')
                ->with('aria-live', 'polite');
        }
    }

    /**
     * Previsualizar el archivo sin persistencia.
     */
    public function preview(ImportUsuariosRequest $request)
    {
        DB::beginTransaction();

        try {
            $file = $request->file('archivo');
            $this->validateImportFile($file);

            $fileName = 'preview_' . Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('imports/temp', $fileName);

            $preview = $this->importService->previewImport($filePath);

            activity('user_import')->causedBy(Auth::user())
                ->withProperties([
                    'action' => 'preview_import',
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'rows_count' => $preview['total_rows'],
                    'valid_rows' => $preview['valid_rows'],
                    'invalid_rows' => $preview['invalid_rows'],
                    'classification' => 'classified'
                ])->log('Vista previa generada');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vista previa generada correctamente',
                'data' => $preview,
                'temp_file' => $fileName,
                'aria_message' => "Vista previa: {$preview['valid_rows']} válidos, {$preview['invalid_rows']} con errores"
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            return $this->handleValidationException($e, $file);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->handleGenericException($e, 'preview');
        }
    }

    /**
     * Importar datos del archivo, creando o actualizando usuarios.
     */
    public function import(ImportUsuariosRequest $request)
    {
        DB::beginTransaction();

        try {
            $filePath = $this->resolveImportFilePath($request);
            $result = $this->importService->processImport($filePath, [
                'update_existing' => $request->boolean('actualizar_existentes'),
                'send_notifications' => $request->boolean('enviar_notificaciones'),
                'default_password' => $request->input('password_default'),
                'assign_role' => $request->input('rol_default'),
                'require_password_change' => $request->boolean('cambiar_password', true)
            ]);

            $this->cleanupTempFiles($filePath);

            activity('user_import')->causedBy(Auth::user())
                ->withProperties([
                    'action' => 'import_completed',
                    'result' => $result,
                    'ip_address' => request()->ip(),
                    'classification' => 'classified'
                ])->log('Importación finalizada');

            DB::commit();

            return redirect()->route('users.import.index')
                ->with('success', "Importación completada: {$result['imported']} nuevos, {$result['updated']} actualizados.")
                ->with('import_results', $result)
                ->with('aria-live', 'polite');
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Errores de validación en el archivo')
                ->with('validation_errors', $this->formatValidationErrors($e->failures()))
                ->with('aria-live', 'assertive');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->handleGenericException($e, 'import');
        }
    }

    /**
     * Descargar plantilla de importación.
     */
    public function downloadTemplate()
    {
        try {
            $filePath = $this->importService->generateTemplate();

            activity('user_import')->causedBy(Auth::user())
                ->withProperties([
                    'action' => 'download_template',
                    'classification' => 'public'
                ])->log('Plantilla descargada');

            return response()->download($filePath, 'plantilla_importacion_usuarios.xlsx', [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Cache-Control' => 'no-store',
                'Pragma' => 'no-cache',
            ])->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return $this->handleGenericException($e, 'download');
        }
    }

    /**
     * Ver historial de importaciones.
     */
    public function history(Request $request)
    {
        try {
            $history = $this->importService->getImportHistory($request->only([
                'user_id', 'date_from', 'date_to', 'per_page'
            ]));

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $history,
                    'aria_message' => "Se encontraron {$history->total()} registros"
                ]);
            }

            return view('modules.importar.history', compact('history'));
        } catch (\Exception $e) {
            return $this->handleGenericException($e, 'history', $request);
        }
    }

    /**
     * Cancelar una importación activa.
     */
    public function cancel(string $importId)
    {
        try {
            $success = $this->importService->cancelImport($importId);

            if ($success) {
                activity('user_import')->causedBy(Auth::user())
                    ->withProperties([
                        'action' => 'import_cancelled',
                        'import_id' => $importId,
                        'classification' => 'classified'
                    ])->log('Importación cancelada');

                return response()->json([
                    'success' => true,
                    'message' => 'Importación cancelada correctamente',
                    'aria_message' => 'Cancelación exitosa'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No se pudo cancelar la importación',
                'aria_message' => 'Cancelación fallida'
            ], 400);
        } catch (\Exception $e) {
            return $this->handleGenericException($e, 'cancel');
        }
    }

    /**
     * Resolver ruta del archivo a importar.
     */
    protected function resolveImportFilePath(Request $request): string
    {
        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $this->validateImportFile($file);

            $fileName = 'import_' . Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            return $file->storeAs('imports/processed', $fileName);
        }

        $tempFile = $request->input('temp_file');
        $tempPath = 'imports/temp/' . $tempFile;

        if (!Storage::disk('local')->exists($tempPath)) {
            throw new \Exception('Archivo temporal no encontrado');
        }

        return $tempPath;
    }

    /**
     * Validar archivo de importación.
     */
    protected function validateImportFile($file): void
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $mime = $file->getMimeType();

        if (!in_array($ext, ['xlsx', 'xls', 'csv'])) {
            throw new \Exception('Formato de archivo no permitido');
        }

        if ($file->getSize() === 0 || $file->getSize() > 10 * 1024 * 1024) {
            throw new \Exception('El archivo es inválido o demasiado grande');
        }

        $validMimeTypes = [
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel',
            'text/csv',
            'application/csv'
        ];

        if (!in_array($mime, $validMimeTypes)) {
            throw new \Exception('Tipo MIME no válido');
        }
    }

    /**
     * Formatear errores de validación.
     */
    protected function formatValidationErrors(array $failures): array
    {
        return collect($failures)->map(function ($failure) {
            return [
                'row' => $failure->row(),
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors(),
                'values' => $failure->values(),
            ];
        })->toArray();
    }

    /**
     * Eliminar archivos temporales.
     */
    protected function cleanupTempFiles(string $filePath): void
    {
        if (str_starts_with($filePath, 'imports/temp/') && Storage::disk('local')->exists($filePath)) {
            Storage::disk('local')->delete($filePath);
        }
    }

    /**
     * Manejar excepciones genéricas.
     */
    protected function handleGenericException(\Exception $e, string $context, Request $request = null)
    {
        Log::error("Error en {$context} de importación", [
            'error' => $e->getMessage(),
            'user_id' => Auth::id(),
            'classification' => 'reserved'
        ]);

        $message = "Error en la operación. Contacte al administrador.";

        if ($request && $request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'aria_message' => $message
            ], 500);
        }

        return redirect()->back()
            ->with('error', $message)
            ->with('aria-live', 'polite');
    }

    /**
     * Manejar errores de validación.
     */
    protected function handleValidationException(ValidationException $e, $file)
    {
        Log::warning('Errores de validación detectados', [
            'user_id' => Auth::id(),
            'errors' => $e->failures(),
            'classification' => 'classified'
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Errores de validación en el archivo',
            'errors' => $this->formatValidationErrors($e->failures()),
            'aria_message' => 'Corrija los errores y vuelva a intentar.'
        ], 422);
    }
}
