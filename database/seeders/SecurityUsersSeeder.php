<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Location;
use App\Models\Department;
use App\Models\Permission;

class SecurityUsersSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $adminId = 1;

        /** Relacionar roles con permisos (solo si no están ya relacionados) */
        $roles = Role::pluck('id', 'name');
        $permissions = Permission::pluck('id', 'name');

        $rolePermissions = [
            'Administrador' => $permissions->values()->toArray(),
            'Subdirector' => [
                'view_users', 'view_roles',
                'view_assets', 'view_loans', 'approve_loans',
                'view_documents', 'view_audit_logs',
            ],
            'Coordinador' => [
                'view_assets', 'create_assets', 'edit_assets',
                'view_loans', 'create_loans', 'approve_loans',
                'sign_loan_delivery', 'sign_loan_return',
                'upload_documents', 'view_documents',
            ],
            'Funcionario' => [
                'view_assets', 'view_loans', 'create_loans',
                'sign_loan_delivery', 'sign_loan_return',
            ],
            'Portería' => [
                'log_gate_entry', 'log_gate_exit', 'generate_exit_pass',
            ],
            'Aprendiz' => [
                'view_loans', 'create_loans',
                'sign_loan_delivery', 'sign_loan_return',
            ],
        ];

        foreach ($rolePermissions as $roleName => $perms) {
            $roleId = $roles[$roleName] ?? null;
            if (!$roleId) continue;

            foreach ($perms as $permName) {
                $permId = $permissions[$permName] ?? null;
                if (!$permId) continue;

                DB::table('role_permission')->updateOrInsert([
                    'role_id' => $roleId,
                    'permission_id' => $permId,
                ], [
                    'assigned_by' => $adminId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        /** Usuarios de prueba: nombre, apellido, usuario, email, rol, ubicación */
        $usuarios = [
            ['Harold', 'Cordero', 'rootadmin', 'admin@sgpti.edu.co', 'Administrador', 'El Bagre - Sede Principal'],
            ['María', 'Pérez', 'subdirectora', 'm.perez@sena.edu.co', 'Subdirector', 'Punto de Formación – Caucasia'],
            ['Luis', 'Martínez', 'coordtic', 'l.martinez@sena.edu.co', 'Coordinador', 'El Bagre - Sede Principal'],
            ['Laura', 'López', 'func_admin', 'l.lopez@sena.edu.co', 'Funcionario', 'Sede Virtual'],
            ['Camilo', 'Gómez', 'porteria1', 'c.gomez@sena.edu.co', 'Portería', 'Portería Principal'],
            ['Julián', 'Mejía', 'aprendiz1', 'julian.mejia@misena.edu.co', 'Aprendiz', 'Zona de Prestamista (Aprendiz)'],
        ];

        foreach ($usuarios as [$nombres, $apellidos, $usuario, $email, $rol, $ubicacion]) {
            $role = Role::where('name', $rol)->first();
            $location = Location::where('name', $ubicacion)->first();
            $department = Department::inRandomOrder()->first();

            User::updateOrCreate(
                ['email' => $email],
                [
                    'first_name' => $nombres,
                    'last_name' => $apellidos,
                    'username' => $usuario,
                    'email' => $email,
                    'password' => Hash::make('password123'), // Cambiar en producción
                    'role_id' => $role?->id,
                    'location_id' => $location?->id,
                    'department_id' => $department?->id,
                    'status' => 'activo',
                    'data_processing_consent' => true,
                    'email_verified_at' => $now,
                    'created_by' => $adminId,
                    'updated_by' => $adminId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
