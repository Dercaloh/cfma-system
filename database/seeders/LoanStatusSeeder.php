<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanStatusSeeder extends Seeder
{
    /**
     * Ejecuta la carga inicial de los estados de préstamo.
     */
    public function run(): void
    {
        DB::table('loan_statuses')->insert([
            ['id' => 1, 'name' => 'pendiente',    'description' => 'Solicitud enviada por el usuario.'],
            ['id' => 2, 'name' => 'aprobado',     'description' => 'Solicitud aprobada por el supervisor o subdirector.'],
            ['id' => 3, 'name' => 'entregado',    'description' => 'Activo entregado al solicitante.'],
            ['id' => 4, 'name' => 'devuelto',     'description' => 'Activo devuelto correctamente.'],
            ['id' => 5, 'name' => 'rechazado',    'description' => 'Solicitud rechazada por incumplimiento o error.'],
            ['id' => 6, 'name' => 'cancelado',    'description' => 'Cancelado por el solicitante o por fuerza mayor.'],
            ['id' => 7, 'name' => 'vencido',      'description' => 'Plazo máximo de préstamo vencido sin devolución.'],
        ]);
    }
}
