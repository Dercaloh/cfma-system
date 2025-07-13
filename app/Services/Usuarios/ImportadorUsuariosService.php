<?php
namespace App\Services\Usuarios;

use App\Imports\UsersImport;
use App\Models\Users\User;
use App\Models\Locations\Branch;
use App\Models\Locations\Department;
use App\Models\Locations\Location;
use App\Models\Programs\Position;
use App\Models\AccessControl\Role;
use App\Helpers\CryptoHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Carbon\Carbon;
use App\Exports\TemplateExport;

/**
 * Servicio para importación masiva de usuarios
 */
class ImportadorUsuariosService
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELLED = 'cancelled';

    const MAX_ROWS_PER_BATCH = 100;
    const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
    const MAX_PREVIEW_ROWS = 50;



    /**
     * Generar preview de importación
     */
    public function previewImport(string $filePath): array
    {
        try {
            $this->validateFile($filePath);
            $import = new UsersImport();
            $data = Excel::toCollection($import, Storage::disk('local')->path($filePath))->first();

            if ($data->isEmpty()) {
                throw new \Exception('El archivo está vacío o no tiene datos válidos');
            }

            $previewData = $this->processPreviewData($data);
            $validationResults = $this->validatePreviewData($previewData);

            return [
                'total_rows' => $data->count(),
                'preview_rows' => $previewData->slice(0, self::MAX_PREVIEW_ROWS)->toArray(),
                'valid_rows' => $validationResults['valid_count'],
                'invalid_rows' => $validationResults['invalid_count'],
                'errors' => $validationResults['errors'],
                'warnings' => $validationResults['warnings'],
                'duplicates' => $validationResults['duplicates'],
                'summary' => [
                    'new_users' => $validationResults['new_users'],
                    'existing_users' => $validationResults['existing_users'],
                    'departments' => $validationResults['departments_found'],
                    'positions' => $validationResults['positions_found'],
                    'branches' => $validationResults['branches_found']
                ]
            ];

        } catch (ValidationException $e) {
            Log::warning('Errores de validación en preview', [
                'file_path' => $filePath,
                'failures' => $e->failures(),
                'user_id' => Auth::id(),
                'classification' => 'classified'
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error en preview de importación', [
                'file_path' => $filePath,
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'classification' => 'reserved'
            ]);
            throw new \Exception('Error procesando preview: ' . $e->getMessage());
        }
    }

    /**
     * Procesar importación masiva - CORRECCIÓN APLICADA
     */
    public function processImport(string $filePath, array $options = []): array
    {
        $importId = $this->generateImportId();

        try {
            $this->logImportStart($importId, $filePath, $options);
            $this->validateFile($filePath);

            $options = array_merge([
                'update_existing' => false,
                'send_notifications' => false,
                'default_password' => null,
                'assign_role' => null,
                'require_password_change' => true,
                'batch_size' => self::MAX_ROWS_PER_BATCH
            ], $options);

            $results = [
                'import_id' => $importId,
                'imported' => 0,
                'updated' => 0,
                'skipped' => 0,
                'errors' => [],
                'errors_count' => 0,
                'warnings' => [],
                'processing_time' => 0
            ];

            $startTime = microtime(true);

            DB::beginTransaction();

            $import = new UsersImport();
            Excel::import($import, Storage::disk('local')->path($filePath));

            // CORRECCIÓN: Solo usar failures(), no errors()
            $failures = $import->failures();

            // Contar registros procesados
            $processedCount = $this->countProcessedRecords($import);
            $results['imported'] = $processedCount['new'];
            $results['updated'] = $processedCount['updated'];
            $results['skipped'] = $failures->count();
            $results['errors'] = $this->formatImportErrors($failures->toArray());
            $results['errors_count'] = $failures->count();

            if ($options['assign_role'] && $results['imported'] > 0) {
                $this->assignDefaultRole($options['assign_role'], $results['imported']);
            }

            if ($options['send_notifications'] && ($results['imported'] > 0 || $results['updated'] > 0)) {
                $this->sendImportNotifications($results, $options);
            }

            DB::commit();

            $results['processing_time'] = round(microtime(true) - $startTime, 2);
            $this->logImportSuccess($importId, $results);

            return $results;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error en importación masiva', [
                'import_id' => $importId,
                'error' => $e->getMessage(),
                'file_path' => $filePath,
                'user_id' => Auth::id(),
                'classification' => 'reserved'
            ]);
            $this->logImportFailure($importId, $e->getMessage());
            throw new \Exception('Error en importación: ' . $e->getMessage());
        }
    }

    /**
     * Generar plantilla de importación
     */
    public function generateTemplate(): string
    {
        try {
            $branches = Branch::where('status', 'activo')->orderBy('name')->get();
            $departments = Department::where('status', 'activo')->orderBy('name')->get();
            $positions = Position::where('status', 'activo')->orderBy('name')->get();
            $locations = Location::where('status', 'activo')->orderBy('name')->get();

            $templateData = $this->buildTemplateData($branches, $departments, $positions, $locations);

            $fileName = 'plantilla_importacion_usuarios_' . Carbon::now()->format('Y_m_d_His') . '.xlsx';
            $filePath = 'templates/' . $fileName;

            Excel::store(new TemplateExport($templateData), $filePath, 'local');

            return Storage::disk('local')->path($filePath);

        } catch (\Exception $e) {
            Log::error('Error generando plantilla de importación', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'classification' => 'reserved'
            ]);
            throw new \Exception('Error generando plantilla: ' . $e->getMessage());
        }
    }

    /**
     * Obtener historial de importaciones
     */
    public function getImportHistory(array $filters = [])
    {
        try {
            $query = \Spatie\Activitylog\Models\Activity::where('log_name', 'user_import')
                ->where('event', 'import_completed')
                ->with('causer')
                ->orderBy('created_at', 'desc');

            if (!empty($filters['user_id'])) {
                $query->where('causer_id', $filters['user_id']);
            }

            if (!empty($filters['date_from'])) {
                $query->whereDate('created_at', '>=', $filters['date_from']);
            }

            if (!empty($filters['date_to'])) {
                $query->whereDate('created_at', '<=', $filters['date_to']);
            }

            return $query->paginate($filters['per_page'] ?? 15);

        } catch (\Exception $e) {
            Log::error('Error obteniendo historial de importaciones', [
                'error' => $e->getMessage(),
                'filters' => $filters,
                'user_id' => Auth::id(),
                'classification' => 'reserved'
            ]);
            throw new \Exception('Error obteniendo historial: ' . $e->getMessage());
        }
    }

    /**
     * Cancelar importación en proceso
     */
    public function cancelImport(string $importId): bool
    {
        try {
            activity('user_import')
                ->causedBy(Auth::user())
                ->withProperties([
                    'import_id' => $importId,
                    'status' => self::STATUS_CANCELLED,
                    'cancelled_at' => now()->toISOString(),
                    'classification' => 'classified'
                ])
                ->log('Importación cancelada');

            return true;

        } catch (\Exception $e) {
            Log::error('Error cancelando importación', [
                'import_id' => $importId,
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'classification' => 'reserved'
            ]);
            return false;
        }
    }

    /**
     * Validar archivo de importación
     */
    protected function validateFile(string $filePath): void
    {
        if (!Storage::disk('local')->exists($filePath)) {
            throw new \Exception('Archivo no encontrado');
        }

        $fileSize = Storage::disk('local')->size($filePath);
        if ($fileSize > self::MAX_FILE_SIZE) {
            throw new \Exception('El archivo excede el tamaño máximo permitido');
        }

        if ($fileSize === 0) {
            throw new \Exception('El archivo está vacío');
        }
    }

    /**
     * Procesar datos para preview
     */
    protected function processPreviewData(Collection $data): Collection
    {
        return $data->map(function ($row, $index) {
            $processedRow = $row->toArray();
            $processedRow['_row_number'] = $index + 2;
            $processedRow['_status'] = 'pending';
            $processedRow['_errors'] = [];
            $processedRow['_warnings'] = [];

            if (empty($processedRow['username'])) {
                $processedRow['_errors'][] = 'Username requerido';
                $processedRow['_status'] = 'error';
            }

            if (empty($processedRow['email'])) {
                $processedRow['_errors'][] = 'Email requerido';
                $processedRow['_status'] = 'error';
            }

            if (!empty($processedRow['username'])) {
                $existingUser = User::where('username', $processedRow['username'])->first();
                if ($existingUser) {
                    $processedRow['_warnings'][] = 'Usuario ya existe, se actualizará';
                    $processedRow['_existing_user'] = true;
                }
            }

            return $processedRow;
        });
    }

    /**
     * Validar datos de preview
     */
    protected function validatePreviewData(Collection $data): array
    {
        $validCount = 0;
        $invalidCount = 0;
        $errors = [];
        $warnings = [];
        $duplicates = [];
        $newUsers = 0;
        $existingUsers = 0;

        $departmentsFound = Department::whereIn('id', $data->pluck('department_id')->filter())->count();
        $positionsFound = Position::whereIn('id', $data->pluck('position_id')->filter())->count();
        $branchesFound = Branch::whereIn('id', $data->pluck('branch_id')->filter())->count();

        foreach ($data as $row) {
            if (empty($row['_errors'])) {
                $validCount++;
                if (!empty($row['_existing_user'])) {
                    $existingUsers++;
                } else {
                    $newUsers++;
                }
            } else {
                $invalidCount++;
                $errors[] = [
                    'row' => $row['_row_number'],
                    'errors' => $row['_errors']
                ];
            }

            if (!empty($row['_warnings'])) {
                $warnings[] = [
                    'row' => $row['_row_number'],
                    'warnings' => $row['_warnings']
                ];
            }
        }

        $usernames = $data->pluck('username')->filter();
        $duplicateUsernames = $usernames->duplicates();
        if ($duplicateUsernames->isNotEmpty()) {
            $duplicates['usernames'] = $duplicateUsernames->toArray();
        }

        return [
            'valid_count' => $validCount,
            'invalid_count' => $invalidCount,
            'errors' => $errors,
            'warnings' => $warnings,
            'duplicates' => $duplicates,
            'new_users' => $newUsers,
            'existing_users' => $existingUsers,
            'departments_found' => $departmentsFound,
            'positions_found' => $positionsFound,
            'branches_found' => $branchesFound
        ];
    }

    /**
     * CORRECCIÓN: Contar registros procesados simplificado
     */
    protected function countProcessedRecords(UsersImport $import): array
    {
        $totalFailures = $import->failures()->count();

        // Implementación básica - requiere mejoras según necesidades específicas
         return [
        'new' => $import->newCount,
        'updated' => $import->updatedCount,
        'skipped' => $import->skippedCount,
        'failed' => $import->failures()->count()
    ];
    }

    /**
     * CORRECCIÓN: Formatear errores de importación simplificado
     */
    protected function formatImportErrors(array $failures): array
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
     * Construir datos para plantilla
     */
    protected function buildTemplateData($branches, $departments, $positions, $locations): array
    {
        return [
            'Usuarios' => [
                [
                    'document_type' => 'CC',
                    'first_name' => 'Juan Carlos',
                    'last_name' => 'Pérez García',
                    'username' => 'jperez',
                    'email' => 'jperez@sena.edu.co',
                    'identification_number' => '12345678',
                    'password' => 'TempPass123!',
                    'employee_id' => 'EMP001',
                    'position_id' => $positions->first()->id ?? 1,
                    'phone_number' => '3001234567',
                    'personal_email' => 'juan.perez@gmail.com',
                    'institutional_email' => 'juan.perez@sena.edu.co',
                    'department_id' => $departments->first()->id ?? 1,
                    'branch_id' => $branches->first()->id ?? 1,
                    'location_id' => $locations->first()->id ?? 1,
                    'status' => 'activo',
                    'account_valid_from' => Carbon::now()->format('Y-m-d'),
                    'account_valid_until' => Carbon::now()->addYear()->format('Y-m-d'),
                ]
            ],
            'Instrucciones' => $this->getInstructions()
        ];
    }

    /**
     * Obtener instrucciones para la plantilla
     */
    protected function getInstructions(): array
    {
        return [
            [
                'Campo' => 'username',
                'Descripción' => 'Nombre de usuario (único)',
                'Valores_Permitidos' => 'Texto hasta 50 caracteres, sin espacios',
                'Requerido' => 'SÍ',
                'Ejemplo' => 'jperez'
            ],
            [
                'Campo' => 'email',
                'Descripción' => 'Correo electrónico (único)',
                'Valores_Permitidos' => 'Email válido',
                'Requerido' => 'SÍ',
                'Ejemplo' => 'jperez@sena.edu.co'
            ]
        ];
    }

    /**
     * Asignar rol por defecto
     */
    protected function assignDefaultRole(string $roleName, int $userCount): void
    {
        try {
            $role = Role::where('name', $roleName)->first();
            if (!$role) {
                Log::warning('Rol no encontrado para asignación por defecto', [
                    'role_name' => $roleName,
                    'user_count' => $userCount
                ]);
                return;
            }
            // Implementar lógica de asignación según necesidades
        } catch (\Exception $e) {
            Log::error('Error asignando rol por defecto', [
                'role_name' => $roleName,
                'error' => $e->getMessage(),
                'classification' => 'reserved'
            ]);
        }
    }

    /**
     * Enviar notificaciones de importación
     */
    protected function sendImportNotifications(array $results, array $options): void
    {
        try {
            // Implementar envío de notificaciones
        } catch (\Exception $e) {
            Log::error('Error enviando notificaciones de importación', [
                'error' => $e->getMessage(),
                'results' => $results,
                'classification' => 'reserved'
            ]);
        }
    }

    /**
     * Generar ID único para importación
     */
    protected function generateImportId(): string
    {
        return 'import_' . Auth::id() . '_' . now()->timestamp . '_' . uniqid();
    }

    /**
     * Registrar inicio de importación
     */
    protected function logImportStart(string $importId, string $filePath, array $options): void
    {
        activity('user_import')
            ->causedBy(Auth::user())
            ->withProperties([
                'import_id' => $importId,
                'file_path' => basename($filePath),
                'options' => $options,
                'status' => self::STATUS_PROCESSING,
                'started_at' => now()->toISOString(),
                'classification' => 'classified'
            ])
            ->log('Importación iniciada');
    }

    /**
     * Registrar éxito de importación
     */
    protected function logImportSuccess(string $importId, array $results): void
    {
        activity('user_import')
            ->causedBy(Auth::user())
            ->withProperties([
                'import_id' => $importId,
                'results' => $results,
                'status' => self::STATUS_COMPLETED,
                'completed_at' => now()->toISOString(),
                'classification' => 'classified'
            ])
            ->log('Importación completada exitosamente');
    }

    /**
     * Registrar fallo de importación
     */
    protected function logImportFailure(string $importId, string $error): void
    {
        activity('user_import')
            ->causedBy(Auth::user())
            ->withProperties([
                'import_id' => $importId,
                'error' => $error,
                'status' => self::STATUS_FAILED,
                'failed_at' => now()->toISOString(),
                'classification' => 'reserved'
            ])
            ->log('Importación falló');
    }
}
