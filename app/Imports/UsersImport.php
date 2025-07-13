<?php

namespace App\Imports;

use App\Models\Users\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsErrors, WithBatchInserts, WithChunkReading
{
    use Importable, SkipsFailures, SkipsErrors;

    // Para detectar duplicados en el archivo de importación (username y email)
    protected array $importedUsernames = [];
    protected array $importedEmails = [];
    protected array $importedEmployeeIds = [];
    public int $newCount = 0;
public int $updatedCount = 0;
public int $skippedCount = 0;

    /**
     * Mapear cada fila en un nuevo modelo User o actualizar existente.
     */
     public function model(array $row)
    {
        $username = trim($row['username']);
        $email = trim($row['email']);
        $employeeId = isset($row['employee_id']) ? trim($row['employee_id']) : null;

        // Verificar duplicados dentro del archivo
        if (
            in_array(strtolower($username), array_map('strtolower', $this->importedUsernames)) ||
            in_array(strtolower($email), array_map('strtolower', $this->importedEmails)) ||
            ($employeeId && in_array(strtolower($employeeId), array_map('strtolower', $this->importedEmployeeIds)))
        ) {
            $this->skippedCount++;
            return null;
        }

        // Registrar para futuros controles
        $this->importedUsernames[] = $username;
        $this->importedEmails[] = $email;
        if ($employeeId) {
            $this->importedEmployeeIds[] = $employeeId;
        }

        // Buscar usuario existente
        $user = User::where('username', $username)
            ->orWhere('email', $email)
            ->first();

        $data = [
            'document_type' => $row['document_type'] ?? 'CC',
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'username' => $username,
            'email' => $email,
            'identification_number' => $row['identification_number'],
            'employee_id' => $employeeId,
            'position_id' => $row['position_id'] ?? null,
            'phone_number' => $row['phone_number'] ?? null,
            'personal_email' => $row['personal_email'] ?? null,
            'institutional_email' => $row['institutional_email'] ?? null,
            'department_id' => $row['department_id'] ?? null,
            'branch_id' => $row['branch_id'] ?? null,
            'location_id' => $row['location_id'] ?? null,
            'status' => $row['status'] ?? 'activo',
            'account_valid_from' => $row['account_valid_from'] ?? null,
            'account_valid_until' => $row['account_valid_until'] ?? null,
        ];

        // Incluir contraseña si se proporciona
        if (!empty($row['password'])) {
            $data['password'] = Hash::make($row['password']);
        }

        if ($user) {
            $user->fill($data);
            $user->save();
            $this->updatedCount++;
            return $user;
        }

        if (empty($row['password'])) {
            $this->skippedCount++;
            return null;
        }

        $this->newCount++;
        return new User($data);
    }

    /**
     * Validaciones para la importación
     */
    public function rules(): array
    {
        return [
            '*.document_type' => ['required', 'string', 'in:CC,TI,CE,NIT,PAS'],
            '*.first_name' => 'required|string|max:50',
            '*.last_name' => 'required|string|max:50',
            '*.username' => ['required', 'string', 'max:50', function ($attribute, $value, $fail) {
                $existing = User::where('username', $value)->first();
                if ($existing && !$this->isUpdatingRow($existing, $value, 'username')) {
                    $fail("El username {$value} ya está en uso.");
                }
            }],
            '*.email' => ['required', 'email', function ($attribute, $value, $fail) {
                $existing = User::where('email', $value)->first();
                if ($existing && !$this->isUpdatingRow($existing, $value, 'email')) {
                    $fail("El correo {$value} ya está en uso.");
                }
            }],
            '*.identification_number' => 'required|string|max:20',
            '*.password' => 'nullable|string|min:8',
            '*.employee_id' => ['nullable', 'string', 'max:20', function ($attribute, $value, $fail) {
                if ($value) {
                    $existing = User::where('employee_id', $value)->first();
                    if ($existing && !$this->isUpdatingRow($existing, $value, 'employee_id')) {
                        $fail("El documento empleado {$value} ya está en uso.");
                    }
                }
            }],
            '*.position_id' => 'nullable|integer|exists:positions,id',
            '*.phone_number' => 'nullable|string|max:20',
            '*.personal_email' => 'nullable|email|max:100',
            '*.institutional_email' => 'nullable|email|max:100',
            '*.department_id' => 'nullable|integer|exists:departments,id',
            '*.branch_id' => 'nullable|integer|exists:branches,id',
            '*.location_id' => 'nullable|integer|exists:locations,id',
            '*.status' => ['nullable', 'string', 'in:activo,inactivo,suspendido,eliminado'],
            '*.account_valid_from' => 'nullable|date_format:Y-m-d',
            '*.account_valid_until' => 'nullable|date_format:Y-m-d|after_or_equal:*.account_valid_from',
        ];
    }

    // Ayuda para validar si la fila actual es actualización
    protected function isUpdatingRow($existingUser, $value)
    {
        // Simple lógica: si el valor coincide con el existente, es actualización permitida
        return in_array($existingUser->username ?? '', [$value]) || in_array($existingUser->email ?? '', [$value]) || in_array($existingUser->employee_id ?? '', [$value]);
    }

    /**
     * Para mejorar el rendimiento con lotes y lectura por chunks
     */
    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
