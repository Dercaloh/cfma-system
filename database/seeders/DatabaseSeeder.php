<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta todos los seeders registrados.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            LoanStatusSeeder::class,
            LoanSystemSeeder::class,
        ]);

        // Usuario de prueba con rol "administrador"
        $admin = User::factory()->create([
            'name' => 'Administrador CFMA',
            'email' => 'admin@cfma.local',
            'password' => Hash::make('admin1234'), // ⚠️ cambiar en producción
            'role_id' => 1, // Asumiendo que 1 es el rol de administrador
        ]);
    }
}
