<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, Asset, Loan, LoanStatus};

class LoanSystemSeeder extends Seeder
{
    public function run(): void
    {
        // Limpieza previa (opcional pero recomendado en dev)
        DB::table('loan_details')->delete();
        DB::table('loans')->delete();
        DB::table('assets')->delete();
        DB::table('loan_statuses')->delete();
        DB::table('users')->delete();

        // 1. Crear usuario de prueba
        $user = User::create([
            'name'     => 'Harold Cordero',
            'email'    => 'harold@example.com',
            'password' => Hash::make('password'),
            'role_id'  => 4 // Asegúrate que 4 sea el ID de 'instructor'
        ]);

        // 2. Crear estados de préstamo
        $statuses = [
            ['name' => 'solicitado', 'description' => 'Solicitud en espera de aprobación'],
            ['name' => 'aprobado',   'description' => 'Solicitud aprobada'],
            ['name' => 'entregado',  'description' => 'Activo entregado al usuario'],
            ['name' => 'devuelto',   'description' => 'Activo devuelto correctamente'],
            ['name' => 'rechazado',  'description' => 'Solicitud rechazada'],
        ];

        foreach ($statuses as $status) {
            LoanStatus::create($status);
        }

        // 3. Crear activo disponible
        $asset = Asset::create([
            'name'          => 'Laptop Dell i5',
    'serial_number' => 'SN-DLL-001',
    'placa'         => 'CFMA-001', // si usas placa de inventario físico
    'type'          => 'Portátil',
    'brand'         => 'Dell',
    'model'         => 'Latitude 3410',
    'status'        => 'Disponible',
    'condition'     => 'Bueno',
    'location'      => 'Con usuario',
    'ownership'     => 'Personal',
    'assigned_to'   => null, // o ID de usuario si aplica
    'loanable'      => true,
    'movable'       => true,
    'description'   => 'Equipo para formación técnica en programación.',
        ]);

        // 4. Crear préstamo
        $loan = Loan::create([
            'user_id'      => $user->id,
            'asset_id'     => $asset->id,
            'status_id'    => LoanStatus::where('name', 'solicitado')->value('id'),
            'requested_at' => now(),
        ]);

        // 5. Crear detalle del préstamo
        $loan->details()->create([
            'loan_id'          => $loan->id,
            'tipo_de_uso'     => 'formativo',
            'sede'             => 'CFMA Principal',
            'hora_entrega'     => '09:00',
            'programa' => 'ADSI',
            'ficha'            => '2721747',
            'instructor'       => 'Harold Cordero',
        ]);
    }
}
