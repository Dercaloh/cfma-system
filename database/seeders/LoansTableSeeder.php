<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\User;
use App\Models\Asset;
use App\Models\LoanStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoansTableSeeder extends Seeder
{
    public function run(): void
    {
        // Estados
        $estadoSolicitado = LoanStatus::where('name', 'Solicitado')->first();
        $estadoAprobado   = LoanStatus::where('name', 'Aprobado')->first();
        $estadoPrestado   = LoanStatus::where('name', 'Prestado')->first();

        // Roles
        $aprendices   = User::whereHas('role', fn($q) => $q->where('name', 'Aprendiz'))->get();
        $funcionarios = User::whereHas('role', fn($q) => $q->where('name', 'Funcionario'))->get();
        $coordinador  = User::whereHas('role', fn($q) => $q->where('name', 'Coordinador'))->first();
        $portero      = User::whereHas('role', fn($q) => $q->where('name', 'Portería'))->first();

        // Activos disponibles
        $activos = Asset::where('status', 'Disponible')->take(20)->get();

        $solicitantes = $aprendices->merge($funcionarios);

        foreach ($solicitantes as $i => $usuario) {
            $activo = $activos[$i] ?? null;
            if (!$activo) break;

            $estado = $i % 3 === 0 ? $estadoSolicitado : ($i % 3 === 1 ? $estadoAprobado : $estadoPrestado);
            $loan = Loan::create([
                'user_id'      => $usuario->id,
                'asset_id'     => $activo->id,
                'status_id'    => $estado->id,
                'requested_at' => now()->subDays(rand(1, 10)),
                'approved_by'  => $estado->name !== 'Solicitado' ? $coordinador?->id : null,
                'approved_at'  => $estado->name !== 'Solicitado' ? now()->subDays(rand(1, 5)) : null,
                'delivered_by' => $estado->name === 'Prestado' ? $portero?->id : null,
                'delivered_at' => $estado->name === 'Prestado' ? now()->subDays(rand(0, 2)) : null,
                'notes'        => "Solicitud de préstamo simulada por {$usuario->username}",
                'created_by'   => 1,
                'updated_by'   => 1,
            ]);

            // Actualiza estado del activo si fue prestado
            if ($estado->name === 'Prestado') {
                $activo->update(['status' => 'Prestado']);
            }
        }
    }
}
