<?php

namespace Database\Seeders;

use App\Models\LoanStatus;
use Illuminate\Database\Seeder;

class LoanStatusesTableSeeder extends Seeder
{
    public function run(): void
    {
        $estados = [
            ['name' => 'Solicitado',     'description' => 'Esperando revisión del préstamo',           'order_index' => 1],
            ['name' => 'Aprobado',       'description' => 'Préstamo autorizado por el responsable',    'order_index' => 2],
            ['name' => 'Entregado',      'description' => 'Activo entregado al usuario',               'order_index' => 3],
            ['name' => 'Devuelto',       'description' => 'Activo retornado y verificado',             'order_index' => 4],
            ['name' => 'Rechazado',      'description' => 'Solicitud denegada por el responsable',     'order_index' => 5],
            ['name' => 'Cancelado',      'description' => 'Solicitud anulada antes de la entrega',     'order_index' => 6],
            ['name' => 'Retrasado',      'description' => 'Entrega o devolución fuera de tiempo',      'order_index' => 7],
            ['name' => 'Incidencia',     'description' => 'Activo extraviado, dañado o con novedad',   'order_index' => 8],
        ];

        foreach ($estados as $estado) {
            LoanStatus::updateOrCreate(
                ['name' => $estado['name']],
                [
                    'description' => $estado['description'],
                    'order_index' => $estado['order_index'],
                    'created_by' => 1,
                    'updated_by' => 1,
                ]
            );
        }
    }
}
