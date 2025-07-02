<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Location;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Datos de ejemplo: [nombre, apellido, usuario, email, rol, sede]
        $usuarios = [
            ['Harold', 'Cordero', 'rootadmin', 'admin@sgpti.edu.co', 'Administrador', 'El Bagre'],
            ['María', 'Pérez', 'subdirectora', 'm.perez@sena.edu.co', 'Subdirector', 'Caucasia'],
            ['Luis', 'Martínez', 'coordtic', 'l.martinez@sena.edu.co', 'Coordinador', 'El Bagre'],
            ['Laura', 'López', 'func_admin', 'l.lopez@sena.edu.co', 'Funcionario', 'Virtual'],
            ['Camilo', 'Gómez', 'porteria1', 'c.gomez@sena.edu.co', 'Portería', 'El Bagre'],
            ['Julián', 'Mejía', 'aprendiz1', 'julian.mejia@misena.edu.co', 'Aprendiz', 'Extramural'],
        ];

        foreach ($usuarios as $u) {
            $role = Role::where('name', $u[4])->first();
            $location = Location::where('name', $u[5])->first();
            $department = Department::inRandomOrder()->first(); // Asignación aleatoria

            User::updateOrCreate(
                ['email' => $u[3]],
                [
                    'first_name' => $u[0],
                    'last_name' => $u[1],
                    'username' => $u[2],
                    'email' => $u[3],
                    'password' => Hash::make('password123'), // Cambiar en producción
                    'role_id' => $role?->id,
                    'location_id' => $location?->id,
                    'department_id' => $department?->id,
                    'status' => 'activo',
                    'data_processing_consent' => true,
                    'email_verified_at' => now(),
                    'created_by' => 1,
                    'updated_by' => 1,
                ]
            );
        }
    }
}
