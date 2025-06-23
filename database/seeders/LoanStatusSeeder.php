<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            1 => ['pendiente', 'Solicitud enviada por el usuario.'],
            2 => ['aprobado', 'Solicitud aprobada por el supervisor o subdirector.'],
            3 => ['entregado', 'Activo entregado al solicitante.'],
            4 => ['devuelto', 'Activo devuelto correctamente.'],
            5 => ['rechazado', 'Solicitud rechazada por incumplimiento o error.'],
            6 => ['cancelado', 'Cancelado por el solicitante o por fuerza mayor.'],
            7 => ['vencido', 'Plazo máximo de préstamo vencido sin devolución.'],
        ];

        foreach ($statuses as $id => [$name, $description]) {
            DB::table('loan_statuses')->updateOrInsert(
                ['id' => $id],
                ['name' => $name, 'description' => $description]
            );
        }
    }
}
