<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Administrador',
                'description' => 'Acceso root total al sistema',
                'level' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Subdirector',
                'description' => 'Administrador del centro sin acceso root',
                'level' => 1,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coordinador',
                'description' => 'Supervisor de áreas académicas o formativas',
                'level' => 2,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Funcionario',
                'description' => 'Instructores, administrativos y contratistas',
                'level' => 3,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Portería',
                'description' => 'Encargado de registrar entradas y salidas',
                'level' => 4,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vocero',
                'description' => 'Representante estudiantil principal',
                'level' => 5,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vocero Suplente',
                'description' => 'Sustituto del vocero principal',
                'level' => 6,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aprendiz',
                'description' => 'Rol de formación, sin privilegios administrativos',
                'level' => 7,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
