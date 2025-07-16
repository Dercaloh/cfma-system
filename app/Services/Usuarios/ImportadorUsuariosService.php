<?php

namespace App\Services\Usuarios;

use App\Imports\UsersImport;
use App\Models\Users\User;
use App\Models\Locations\Branch;
use App\Models\Locations\Department;
use App\Models\Locations\Location;
use App\Models\Programs\Position;
use App\Models\AccessControl\Role;
use App\Exports\TemplateExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ImportadorUsuariosService
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELLED = 'cancelled';

    const MAX_ROWS_PER_BATCH = 100;
    const MAX_FILE_SIZE = 10485760; // 10MB
    const MAX_PREVIEW_ROWS = 50;

    public function previewImport(string $filePath): array
    {
        try {
            $this->validateFile($filePath);

            $import = new UsersImport();
            $data = Excel::toCollection($import, Storage::disk('local')->path($filePath))->first();

            if ($data->isEmpty()) {
                throw new \Exception('El archivo no contiene datos válidos.');
            }

            $preview = $this->processPreviewData($data);
            $validaciones = $this->validatePreviewData($preview);

            return [
                'total_rows' => $data->count(),
                'preview_rows' => $preview->take(self::MAX_PREVIEW_ROWS)->toArray(),
                'valid_rows' => $validaciones['valid_count'],
                'invalid_rows' => $validaciones['invalid_count'],
                'errors' => $validaciones['errors'],
                'warnings' => $validaciones['warnings'],
                'duplicates' => $validaciones['duplicates'],
                'summary' => [
                    'new_users' => $validaciones['new_users'],
                    'existing_users' => $validaciones['existing_users'],
                    'departments' => $validaciones['departments_found'],
                    'positions' => $validaciones['positions_found'],
                    'branches' => $validaciones['branches_found'],
                ]
            ];

        } catch (\Throwable $e) {
            Log::error('Error al previsualizar importación', [
                'file' => $filePath,
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);
            throw new \Exception('Error procesando la previsualización: ' . $e->getMessage());
        }
    }

    public function processImport(string $filePath, array $options = []): array
    {
        $importId = $this->generateImportId();
        $startTime = microtime(true);

        try {
            $this->logImportStart($importId, $filePath, $options);
            $this->validateFile($filePath);

            $options = array_merge([
                'update_existing' => false,
                'send_notifications' => false,
                'assign_role' => null,
                'default_password' => null,
                'require_password_change' => true
            ], $options);

            DB::beginTransaction();

            $import = new UsersImport($options);
            Excel::import($import, Storage::disk('local')->path($filePath));

            $results = [
                'import_id' => $importId,
                'imported' => $import->newCount ?? 0,
                'updated' => $import->updatedCount ?? 0,
                'skipped' => $import->skippedCount ?? 0,
                'errors' => $this->formatImportErrors($import->failures()->toArray()),
                'errors_count' => $import->failures()->count(),
                'warnings' => $import->getWarnings() ?? [],
                'processing_time' => round(microtime(true) - $startTime, 2)
            ];

            if ($options['assign_role'] && $results['imported'] > 0) {
                $this->assignDefaultRole($options['assign_role'], $results['imported']);
            }

            DB::commit();
            $this->logImportSuccess($importId, $results);

            return $results;

        } catch (\Throwable $e) {
            DB::rollBack();
            $this->logImportFailure($importId, $e->getMessage());
            throw new \Exception('Error en importación: ' . $e->getMessage());
        }
    }

    public function generateTemplate(): string
    {
        try {
            $branches = Branch::active()->get();
            $departments = Department::active()->get();
            $positions = Position::active()->get();
            $locations = Location::active()->get();

            $templateData = [
                'Usuarios' => [[
                    'username' => 'jperez',
                    'email' => 'jperez@sena.edu.co',
                    'document_number' => '12345678',
                    'position_id' => $positions->first()->id ?? 1,
                    'branch_id' => $branches->first()->id ?? 1,
                    'department_id' => $departments->first()->id ?? 1,
                    'location_id' => $locations->first()->id ?? 1,
                    'status' => 'activo',
                ]],
                'Instrucciones' => $this->getInstructions()
            ];

            $fileName = 'plantilla_usuarios_' . Carbon::now()->format('Ymd_His') . '.xlsx';
            $filePath = 'templates/' . $fileName;

            Excel::store(new TemplateExport($templateData), $filePath, 'local');
            return Storage::disk('local')->path($filePath);

        } catch (\Throwable $e) {
            Log::error('Error generando plantilla', ['error' => $e->getMessage()]);
            throw new \Exception('No se pudo generar la plantilla.');
        }
    }

    public function getImportHistory(array $filters = [])
    {
        return \Spatie\Activitylog\Models\Activity::query()
            ->where('log_name', 'user_import')
            ->with('causer')
            ->when($filters['user_id'] ?? null, fn($q, $id) => $q->where('causer_id', $id))
            ->when($filters['date_from'] ?? null, fn($q, $from) => $q->whereDate('created_at', '>=', $from))
            ->when($filters['date_to'] ?? null, fn($q, $to) => $q->whereDate('created_at', '<=', $to))
            ->orderByDesc('created_at')
            ->paginate($filters['per_page'] ?? 20);
    }

    public function cancelImport(string $importId): bool
    {
        try {
            activity('user_import')
                ->causedBy(Auth::user())
                ->withProperties([
                    'import_id' => $importId,
                    'status' => self::STATUS_CANCELLED,
                    'cancelled_at' => now()->toISOString()
                ])
                ->log('Importación cancelada');
            return true;

        } catch (\Throwable $e) {
            Log::error('Cancelación fallida', ['import_id' => $importId, 'error' => $e->getMessage()]);
            return false;
        }
    }

    protected function validateFile(string $filePath): void
    {
        if (!Storage::disk('local')->exists($filePath)) {
            throw new \Exception('Archivo no encontrado');
        }

        $size = Storage::disk('local')->size($filePath);
        if ($size === 0) throw new \Exception('El archivo está vacío');
        if ($size > self::MAX_FILE_SIZE) throw new \Exception('El archivo excede el tamaño máximo permitido');
    }

    protected function processPreviewData(Collection $data): Collection
    {
        return $data->map(function ($row, $i) {
            $row = $row->toArray();
            $row['_row_number'] = $i + 2;
            $row['_errors'] = [];
            $row['_warnings'] = [];
            $row['_status'] = 'pending';

            if (empty($row['username'])) {
                $row['_errors'][] = 'Usuario requerido';
                $row['_status'] = 'error';
            }
            if (empty($row['email']) || !filter_var($row['email'], FILTER_VALIDATE_EMAIL)) {
                $row['_errors'][] = 'Correo inválido';
                $row['_status'] = 'error';
            }

            if (!empty($row['username']) && User::where('username', $row['username'])->exists()) {
                $row['_warnings'][] = 'Usuario ya existe';
                $row['_existing_user'] = true;
            }

            return $row;
        });
    }

    protected function validatePreviewData(Collection $data): array
    {
        $valid = $invalid = $existing = $new = 0;
        $errors = $warnings = $duplicates = [];

        $departments = Department::whereIn('id', $data->pluck('department_id')->filter())->count();
        $positions = Position::whereIn('id', $data->pluck('position_id')->filter())->count();
        $branches = Branch::whereIn('id', $data->pluck('branch_id')->filter())->count();

        foreach ($data as $row) {
            if (empty($row['_errors'])) {
                $valid++;
                $row['_existing_user'] ?? $new++;
                $row['_existing_user'] && $existing++;
            } else {
                $invalid++;
                $errors[] = ['row' => $row['_row_number'], 'errors' => $row['_errors']];
            }

            if (!empty($row['_warnings'])) {
                $warnings[] = ['row' => $row['_row_number'], 'warnings' => $row['_warnings']];
            }
        }

        $usernames = $data->pluck('username')->filter();
        $duplicateUsernames = $usernames->duplicates();
        if ($duplicateUsernames->isNotEmpty()) {
            $duplicates['usernames'] = $duplicateUsernames->toArray();
        }

        return compact(
            'valid', 'invalid', 'errors', 'warnings', 'duplicates',
            'new', 'existing',
            'departments', 'positions', 'branches'
        );
    }

    protected function formatImportErrors(array $failures): array
    {
        return collect($failures)->map(fn($f) => [
            'row' => $f->row(),
            'attribute' => $f->attribute(),
            'errors' => $f->errors(),
            'values' => $f->values()
        ])->toArray();
    }

    protected function assignDefaultRole(string $roleName, int $count): void
    {
        try {
            $role = Role::where('name', $roleName)->first();
            if (!$role) {
                Log::warning('Rol no encontrado', ['rol' => $roleName]);
            }
            // Implementar lógica si es necesario
        } catch (\Throwable $e) {
            Log::error('Error asignando rol por defecto', ['error' => $e->getMessage()]);
        }
    }

    protected function generateImportId(): string
    {
        return 'import_' . Auth::id() . '_' . now()->format('Ymd_His');
    }

    protected function logImportStart(string $id, string $file, array $options): void
    {
        activity('user_import')
            ->causedBy(Auth::user())
            ->withProperties([
                'import_id' => $id,
                'file_path' => basename($file),
                'options' => $options,
                'status' => self::STATUS_PROCESSING,
                'started_at' => now()->toISOString()
            ])
            ->log('Importación iniciada');
    }

    protected function logImportSuccess(string $id, array $results): void
    {
        activity('user_import')
            ->causedBy(Auth::user())
            ->withProperties([
                'import_id' => $id,
                'results' => $results,
                'status' => self::STATUS_COMPLETED,
                'completed_at' => now()->toISOString()
            ])
            ->log('Importación completada');
    }

    protected function logImportFailure(string $id, string $msg): void
    {
        activity('user_import')
            ->causedBy(Auth::user())
            ->withProperties([
                'import_id' => $id,
                'error' => $msg,
                'status' => self::STATUS_FAILED,
                'failed_at' => now()->toISOString()
            ])
            ->log('Importación fallida');
    }

    protected function getInstructions(): array
    {
        return [
            ['Campo' => 'username', 'Descripción' => 'Nombre de usuario único', 'Requerido' => 'Sí'],
            ['Campo' => 'email', 'Descripción' => 'Correo electrónico válido', 'Requerido' => 'Sí'],
            ['Campo' => 'document_number', 'Descripción' => 'Documento de identidad', 'Requerido' => 'Sí']
        ];
    }
}
