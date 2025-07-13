<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ImportUsuariosRequest;
use App\Imports\UsersImport;
use App\Models\Users\User;
use App\Models\Locations\Branch;
use App\Models\Locations\Department;
use App\Models\Locations\Location;
use App\Models\Programs\Position;
use App\Services\Usuarios\ImportadorUsuariosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Spatie\Activitylog\Facades\CauserResolver;

/**
 * Controlador para la importación masiva de usuarios
 *
 * Cumple con:
 * - Ley 1581 de 2012 (Protección de datos personales)
 * - ISO 27001 (Seguridad de la información)
 * - Resolución 1122 de 2023 (Accesibilidad web)
 * - Ley 1712 de 2014 (Transparencia y acceso a la información)
 *
 * Clasificación de información:
 * - 🟢 Pública: Nombres, cargos, correos institucionales
 * - 🟡 Clasificada: Logs, historial, datos operativos
 * - 🔴 Reservada: Contraseñas, datos sensibles, auditoría
 *
 * @package App\Http\Controllers\Users
 * @author CFMA-SENA Sistema de Gestión
 * @version 1.0.0
 */
class UserImportController extends Controller
{
    /**
     * Servicio de importación de usuarios
     */
    protected ImportadorUsuariosService $importService;

    /**
     * Constructor del controlador
     */
    public function __construct(ImportadorUsuariosService $importService)
    {
        $this->importService = $importService;

        // Aplicar middlewares de seguridad
        $this->middleware(['auth', 'role:admin|super_admin']);
        $this->middleware('throttle:10,1')->only(['import', 'preview']);
    }

    /**
     * Mostrar formulario de importación
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Obtener datos para formulario
            $branches = Branch::where('status', 'activo')->orderBy('name')->get();
            $departments = Department::where('status', 'activo')->orderBy('name')->get();
            $locations = Location::where('status', 'activo')->orderBy('name')->get();
            $positions = Position::where('status', 'activo')->orderBy('name')->get();

            // Registrar actividad (🟡 Información Clasificada)
            activity('user_import')
                ->causedBy(Auth::user())
                ->withProperties([
                    'action' => 'view_import_form',
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'timestamp' => now()->toISOString(),
                    'classification' => 'classified' // 🟡
                ])
                ->log('Usuario accedió al formulario de importación');

            return view('usuarios.import.index', compact(
                'branches',
                'departments',
                'locations',
                'positions'
            ));

        } catch (\Exception $e) {
            Log::error('Error al cargar formulario de importación de usuarios', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'classification' => 'reserved' // 🔴
            ]);

            return redirect()->back()
                ->with('error', 'Error al cargar el formulario. Contacte al administrador.')
                ->with('aria-live', 'polite');
        }
    }

    /**
     * Previsualizar archivo de importación
     *
     * @param ImportUsuariosRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function preview(ImportUsuariosRequest $request)
    {
        DB::beginTransaction();

        try {
            // Validar archivo
            $file = $request->file('archivo');
            $this->validateImportFile($file);

            // Generar nombre único para archivo temporal
            $fileName = 'import_preview_' . Auth::id() . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('imports/temp', $fileName, 'local');

            // Obtener preview usando el servicio
            $preview = $this->importService->previewImport($filePath);

            // Registrar actividad de preview (🟡 Información Clasificada)
            activity('user_import')
                ->causedBy(Auth::user())
                ->withProperties([
                    'action' => 'preview_import',
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'rows_count' => $preview['total_rows'],
                    'valid_rows' => $preview['valid_rows'],
                    'invalid_rows' => $preview['invalid_rows'],
                    'ip_address' => request()->ip(),
                    'classification' => 'classified' // 🟡
                ])
                ->log('Preview de importación generado');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vista previa generada correctamente',
                'data' => $preview,
                'temp_file' => $fileName,
                'aria_message' => "Vista previa lista. {$preview['valid_rows']} registros válidos, {$preview['invalid_rows']} con errores."
            ]);

        } catch (ValidationException $e) {
            DB::rollback();

            Log::warning('Errores de validación en preview de importación', [
                'user_id' => Auth::id(),
                'errors' => $e->failures(),
                'file_name' => $file->getClientOriginalName(),
                'classification' => 'classified' // 🟡
            ]);

            return response()->json([
                'success' => false,
                'message' => 'El archivo contiene errores de validación',
                'errors' => $this->formatValidationErrors($e->failures()),
                'aria_message' => 'Archivo con errores de validación. Revise los datos e intente nuevamente.'
            ], 422);

        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Error en preview de importación', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'classification' => 'reserved' // 🔴
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el archivo',
                'aria_message' => 'Error procesando archivo. Contacte al administrador.'
            ], 500);
        }
    }

    /**
     * Procesar importación masiva de usuarios
     *
     * @param ImportUsuariosRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(ImportUsuariosRequest $request)
    {
        DB::beginTransaction();

        try {
            // Validar archivo o archivo temporal
            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $this->validateImportFile($file);

                $fileName = 'import_' . Auth::id() . '_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('imports/processed', $fileName, 'local');
            } else {
                // Usar archivo temporal de preview
                $tempFile = $request->input('temp_file');
                if (!$tempFile || !Storage::disk('local')->exists('imports/temp/' . $tempFile)) {
                    throw new \Exception('Archivo temporal no encontrado');
                }
                $filePath = 'imports/temp/' . $tempFile;
            }

            // Procesar importación
            $result = $this->importService->processImport($filePath, [
                'update_existing' => $request->boolean('actualizar_existentes', false),
                'send_notifications' => $request->boolean('enviar_notificaciones', false),
                'default_password' => $request->input('password_default'),
                'assign_role' => $request->input('rol_default'),
                'require_password_change' => $request->boolean('cambiar_password', true)
            ]);

            // Limpiar archivos temporales
            $this->cleanupTempFiles($filePath);

            // Registrar actividad exitosa (🟡 Información Clasificada)
            activity('user_import')
                ->causedBy(Auth::user())
                ->withProperties([
                    'action' => 'import_completed',
                    'users_imported' => $result['imported'],
                    'users_updated' => $result['updated'],
                    'users_skipped' => $result['skipped'],
                    'errors_count' => $result['errors_count'],
                    'file_name' => $fileName ?? 'preview_file',
                    'options' => [
                        'update_existing' => $request->boolean('actualizar_existentes'),
                        'send_notifications' => $request->boolean('enviar_notificaciones'),
                        'assign_role' => $request->input('rol_default'),
                    ],
                    'ip_address' => request()->ip(),
                    'classification' => 'classified' // 🟡
                ])
                ->log('Importación de usuarios completada');

            DB::commit();

            // Mensaje de éxito accesible
            $successMessage = "Importación completada: {$result['imported']} usuarios importados, {$result['updated']} actualizados";
            if ($result['skipped'] > 0) {
                $successMessage .= ", {$result['skipped']} omitidos";
            }

            return redirect()->route('users.import.index')
                ->with('success', $successMessage)
                ->with('import_results', $result)
                ->with('aria-live', 'polite');

        } catch (ValidationException $e) {
            DB::rollback();

            Log::warning('Errores de validación en importación', [
                'user_id' => Auth::id(),
                'errors' => $e->failures(),
                'classification' => 'classified' // 🟡
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'El archivo contiene errores de validación')
                ->with('validation_errors', $this->formatValidationErrors($e->failures()))
                ->with('aria-live', 'assertive');

        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Error en importación de usuarios', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'classification' => 'reserved' // 🔴
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al procesar la importación. Contacte al administrador.')
                ->with('aria-live', 'assertive');
        }
    }

    /**
     * Descargar plantilla de importación
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadTemplate()
    {
        try {
            $templatePath = $this->importService->generateTemplate();

            // Registrar descarga (🟢 Información Pública)
            activity('user_import')
                ->causedBy(Auth::user())
                ->withProperties([
                    'action' => 'download_template',
                    'ip_address' => request()->ip(),
                    'classification' => 'public' // 🟢
                ])
                ->log('Descarga de plantilla de importación');

            return response()->download($templatePath, 'plantilla_importacion_usuarios.xlsx', [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="plantilla_importacion_usuarios.xlsx"',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);

        } catch (\Exception $e) {
            Log::error('Error al generar plantilla de importación', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'classification' => 'reserved' // 🔴
            ]);

            return redirect()->back()
                ->with('error', 'Error al generar la plantilla')
                ->with('aria-live', 'polite');
        }
    }

    /**
     * Obtener historial de importaciones
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function history(Request $request)
    {
        try {
            $history = $this->importService->getImportHistory([
                'user_id' => $request->input('user_id'),
                'date_from' => $request->input('date_from'),
                'date_to' => $request->input('date_to'),
                'per_page' => $request->input('per_page', 15)
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $history,
                    'aria_message' => "Historial cargado: {$history->total()} registros encontrados"
                ]);
            }

            return view('users.import.history', compact('history'));

        } catch (\Exception $e) {
            Log::error('Error al obtener historial de importaciones', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'classification' => 'reserved' // 🔴
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al cargar el historial',
                    'aria_message' => 'Error cargando historial. Contacte al administrador.'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Error al cargar el historial')
                ->with('aria-live', 'polite');
        }
    }

    /**
     * Cancelar importación en proceso
     *
     * @param string $importId
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel($importId)
    {
        try {
            $result = $this->importService->cancelImport($importId);

            if ($result) {
                // Registrar cancelación (🟡 Información Clasificada)
                activity('user_import')
                    ->causedBy(Auth::user())
                    ->withProperties([
                        'action' => 'import_cancelled',
                        'import_id' => $importId,
                        'ip_address' => request()->ip(),
                        'classification' => 'classified' // 🟡
                    ])
                    ->log('Importación cancelada por usuario');

                return response()->json([
                    'success' => true,
                    'message' => 'Importación cancelada correctamente',
                    'aria_message' => 'Importación cancelada exitosamente'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No se pudo cancelar la importación',
                'aria_message' => 'Error cancelando importación'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Error al cancelar importación', [
                'error' => $e->getMessage(),
                'import_id' => $importId,
                'user_id' => Auth::id(),
                'classification' => 'reserved' // 🔴
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error al cancelar la importación',
                'aria_message' => 'Error cancelando importación. Contacte al administrador.'
            ], 500);
        }
    }

    /**
     * Validar archivo de importación
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @throws \Exception
     */
    protected function validateImportFile($file): void
    {
        // Validar extensión
        $allowedExtensions = ['xlsx', 'xls', 'csv'];
        if (!in_array(strtolower($file->getClientOriginalExtension()), $allowedExtensions)) {
            throw new \Exception('Formato de archivo no permitido. Use: ' . implode(', ', $allowedExtensions));
        }

        // Validar tamaño (máximo 10MB)
        if ($file->getSize() > 10 * 1024 * 1024) {
            throw new \Exception('El archivo excede el tamaño máximo permitido (10MB)');
        }

        // Validar tipo MIME
        $allowedMimeTypes = [
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel',
            'text/csv',
            'application/csv'
        ];

        if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
            throw new \Exception('Tipo de archivo no válido');
        }
    }

    /**
     * Formatear errores de validación para mostrar al usuario
     *
     * @param array $failures
     * @return array
     */
    protected function formatValidationErrors(array $failures): array
    {
        $formatted = [];

        foreach ($failures as $failure) {
            $formatted[] = [
                'row' => $failure->row(),
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors(),
                'values' => $failure->values()
            ];
        }

        return $formatted;
    }

    /**
     * Limpiar archivos temporales
     *
     * @param string $filePath
     */
    protected function cleanupTempFiles(string $filePath): void
    {
        try {
            if (Storage::disk('local')->exists($filePath)) {
                Storage::disk('local')->delete($filePath);
            }
        } catch (\Exception $e) {
            Log::warning('Error al limpiar archivo temporal', [
                'file_path' => $filePath,
                'error' => $e->getMessage(),
                'classification' => 'classified' // 🟡
            ]);
        }
    }
}
