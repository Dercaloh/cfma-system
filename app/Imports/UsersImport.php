<?php

namespace App\Imports;

use App\Models\Users\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class UsersImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure,
    SkipsErrors,
    WithBatchInserts,
    WithChunkReading
{
    use Importable, SkipsFailures, SkipsErrors;

    public int $newCount = 0;
    public int $updatedCount = 0;
    public int $skippedCount = 0;

    protected array $importedUsernames = [];
    protected array $importedEmails = [];
    protected array $importedEmployeeIds = [];

    public function model(array $row): ?User
    {
        $username    = trim($row['username'] ?? '');
        $email       = trim($row['email'] ?? '');
        $employeeId  = trim($row['employee_id'] ?? '');

        // Evitar duplicados dentro del archivo
        if (
            in_array(strtolower($username), array_map('strtolower', $this->importedUsernames)) ||
            in_array(strtolower($email), array_map('strtolower', $this->importedEmails)) ||
            (!empty($employeeId) && in_array(strtolower($employeeId), array_map('strtolower', $this->importedEmployeeIds)))
        ) {
            $this->skippedCount++;
            return null;
        }

        // Registrar para próximos registros
        $this->importedUsernames[] = $username;
        $this->importedEmails[] = $email;
        if ($employeeId) {
            $this->importedEmployeeIds[] = $employeeId;
        }

        // Preparar los datos comunes
        $data = [
            'document_type'         => $row['document_type'] ?? 'CC',
            'first_name'            => $row['first_name'] ?? '',
            'last_name'             => $row['last_name'] ?? '',
            'username'              => $username,
            'email'                 => $email,
            'identification_number' => $row['identification_number'] ?? '',
            'employee_id'           => $employeeId,
            'position_id'           => $row['position_id'] ?? null,
            'phone_number'          => $row['phone_number'] ?? null,
            'personal_email'        => $row['personal_email'] ?? null,
            'institutional_email'   => $row['institutional_email'] ?? null,
            'department_id'         => $row['department_id'] ?? null,
            'branch_id'             => $row['branch_id'] ?? null,
            'location_id'           => $row['location_id'] ?? null,
            'status'                => $row['status'] ?? 'activo',
            'account_valid_from'    => $row['account_valid_from'] ?? null,
            'account_valid_until'   => $row['account_valid_until'] ?? null,
        ];

        // Verificar si el usuario ya existe
        $user = User::where('username', $username)
                    ->orWhere('email', $email)
                    ->first();

        // Si el usuario existe, actualizar
        if ($user) {
            if (!empty($row['password'])) {
                $data['password'] = Hash::make($row['password']);
            }
            $user->update($data);
            $this->updatedCount++;
            return $user;
        }

        // Si es nuevo usuario
        $password = !empty($row['password']) ? $row['password'] : 'Soporte2025*';
        $data['password'] = Hash::make($password);

        $this->newCount++;
        return new User($data);
    }

    public function rules(): array
    {
        return [
            '*.document_type' => ['required', 'string', 'in:CC,TI,CE,NIT,PAS'],
            '*.first_name'    => 'required|string|max:50',
            '*.last_name'     => 'required|string|max:50',
            '*.username'      => [
                'required', 'string', 'max:50',
                function ($attribute, $value, $fail) {
                    $existing = User::where('username', $value)->first();
                    if ($existing && !$this->isUpdatingRow($existing, $value, 'username')) {
                        $fail("El username {$value} ya está en uso.");
                    }
                },
            ],
            '*.email' => [
                'required', 'email',
                function ($attribute, $value, $fail) {
                    $existing = User::where('email', $value)->first();
                    if ($existing && !$this->isUpdatingRow($existing, $value, 'email')) {
                        $fail("El correo {$value} ya está en uso.");
                    }
                },
            ],
            '*.identification_number' => 'required|string|max:20',
            '*.password'              => 'nullable|string|min:8',
            '*.employee_id'           => [
                'nullable', 'string', 'max:20',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $existing = User::where('employee_id', $value)->first();
                        if ($existing && !$this->isUpdatingRow($existing, $value, 'employee_id')) {
                            $fail("El ID de empleado {$value} ya está en uso.");
                        }
                    }
                }
            ],
            '*.position_id'         => 'nullable|integer|exists:positions,id',
            '*.phone_number'        => 'nullable|string|max:20',
            '*.personal_email'      => 'nullable|email|max:100',
            '*.institutional_email' => 'nullable|email|max:100',
            '*.department_id'       => 'nullable|integer|exists:departments,id',
            '*.branch_id'           => 'nullable|integer|exists:branches,id',
            '*.location_id'         => 'nullable|integer|exists:locations,id',
            '*.status'              => 'nullable|string|in:activo,inactivo,suspendido,eliminado',
            '*.account_valid_from'  => 'nullable|date_format:Y-m-d',
            '*.account_valid_until' => 'nullable|date_format:Y-m-d|after_or_equal:*.account_valid_from',
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '*.document_type.required' => 'El tipo de documento es obligatorio.',
            '*.document_type.in' => 'Tipo de documento inválido (CC, TI, CE, NIT, PAS).',
            '*.first_name.required' => 'El nombre es obligatorio.',
            '*.last_name.required' => 'El apellido es obligatorio.',
            '*.username.required' => 'El nombre de usuario es obligatorio.',
            '*.username.max' => 'El nombre de usuario no puede superar 50 caracteres.',
            '*.email.required' => 'El correo es obligatorio.',
            '*.email.email' => 'Formato de correo inválido.',
            '*.password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            '*.employee_id.max' => 'El ID de empleado no puede exceder 20 caracteres.',
            '*.position_id.exists' => 'El cargo seleccionado no existe.',
            '*.department_id.exists' => 'La dependencia no es válida.',
            '*.branch_id.exists' => 'La sede no es válida.',
            '*.location_id.exists' => 'La ubicación no es válida.',
            '*.status.in' => 'Estado no válido (activo, inactivo, suspendido, eliminado).',
            '*.account_valid_from.date_format' => 'Formato de fecha inválido (vigencia desde).',
            '*.account_valid_until.date_format' => 'Formato de fecha inválido (vigencia hasta).',
            '*.account_valid_until.after_or_equal' => 'La fecha de fin debe ser posterior o igual a la de inicio.',
        ];
    }

    public function prepareForValidation(array $data): array
    {
        foreach (['username', 'email', 'employee_id'] as $field) {
            if (isset($data[$field])) {
                $data[$field] = trim($data[$field]);
            }
        }
        return $data;
    }

    protected function isUpdatingRow($existingUser, $value, $field): bool
    {
        return isset($existingUser->$field) && strtolower($existingUser->$field) === strtolower($value);
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    // Si quieres usar advertencias personalizadas
    public function getWarnings(): array
    {
        return [];
    }
}
