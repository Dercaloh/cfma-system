<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Crea los roles principales del sistema.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'administrador', 'description' => 'Acceso total', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'subdirector', 'description' => 'Aprueba préstamos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'supervisor', 'description' => 'Reportes y seguimiento', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'instructor', 'description' => 'Solicita préstamos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'portería', 'description' => 'Check-in / Check-out', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('roles')->insert($roles);
    }
}
