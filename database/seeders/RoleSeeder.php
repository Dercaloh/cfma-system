<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'administrador', 'description' => 'Acceso total'],
            ['name' => 'subdirector', 'description' => 'Aprueba préstamos'],
            ['name' => 'supervisor', 'description' => 'Reportes y seguimiento'],
            ['name' => 'instructor', 'description' => 'Solicita préstamos'],
            ['name' => 'portería', 'description' => 'Check-in / Check-out'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                array_merge($role, [
                    'created_at' => now(),
                    'updated_at' => now()
                ])
            );
        }
    }
}
