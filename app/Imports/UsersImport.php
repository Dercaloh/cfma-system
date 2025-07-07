<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Department;
use App\Models\Location;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class UsersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            try {
                // Sanitizar y validar campos requeridos
                $firstName = trim($row['first_name'] ?? '');
                $lastName = trim($row['last_name'] ?? '');
                $email = strtolower(trim($row['email'] ?? ''));
                $roleName = trim($row['role'] ?? '');

                if (!$firstName || !$lastName || !$email || !$roleName) {
                    Log::warning("Fila {$index}: Campos requeridos faltantes.");
                    continue;
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    Log::warning("Fila {$index}: Correo inválido: $email.");
                    continue;
                }

                if (!Role::where('name', $roleName)->exists()) {
                    Log::warning("Fila {$index}: Rol '$roleName' no existe.");
                    continue;
                }

                $department = Department::where('name', trim($row['department'] ?? ''))->first();
                $location = Location::where('name', trim($row['location'] ?? ''))->first();

                // Evita duplicados por correo
                if (User::where('email', $email)->exists()) {
                    Log::info("Fila {$index}: Usuario con email $email ya existe.");
                    continue;
                }

                // Crea usuario
                $user = User::create([
                    'first_name'    => $firstName,
                    'last_name'     => $lastName,
                    'email'         => $email,
                    'username'      => Str::slug($firstName . '.' . $lastName),
                    'password'      => Hash::make(Str::random(10)),
                    'department_id' => $department?->id,
                    'location_id'   => $location?->id,
                ]);

                $user->assignRole($roleName);

                Log::info("Usuario importado: $email (fila $index)");
            } catch (\Throwable $e) {
                Log::error("Error en fila {$index}: " . $e->getMessage());
                continue;
            }
        }
    }
}
