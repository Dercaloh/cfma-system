<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear el rol si no existe
        $adminRole = Role::firstOrCreate(
            ['name' => 'Administrador'],
            ['guard_name' => 'web']
        );

        // 2. Crear el usuario administrador si no existe
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@cfma.sena.edu.co'],
            [
                'first_name' => 'Administrador',
                'last_name' => 'CFMA',
                'username' => 'admin.cfma',
                'password' => Hash::make('Administrador123*'), // cambiar luego en producción
                'status' => 'activo',
                'account_valid_from' => now(),
                'consent_data_processing' => true,
                'consent_timestamp' => now(),
                'privacy_policy_version' => '1.0',
            ]
        );

        // 3. Asignar el rol
        if (! $adminUser->hasRole('Administrador')) {
            $adminUser->assignRole('Administrador');
        }

        $this->command->info('✔ Usuario administrador creado: admin@cfma.sena.edu.co / Contraseña: Administrador123*');
    }
}
