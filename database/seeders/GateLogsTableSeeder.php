<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\GateLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class GateLogsTableSeeder extends Seeder
{
    public function run(): void
    {
        $portero = User::whereHas('role', fn ($q) => $q->where('name', 'Portería'))->first();

        foreach (Loan::with('asset')->get() as $loan) {
            if ($loan->delivered_at && $loan->asset->movable) {

                // Registro de salida
                GateLog::updateOrCreate(
                    ['asset_id' => $loan->asset_id, 'logged_at' => $loan->delivered_at, 'action' => 'salida'],
                    [
                        'user_id'     => $loan->user_id,
                        'action'      => 'salida',
                        'logged_at'   => $loan->delivered_at,
                        'notes'       => 'Salida autorizada con destino educativo.',
                        'created_by'  => $portero?->id,
                        'updated_by'  => $portero?->id,
                    ]
                );

                // Registro de entrada simulado (opcional si se devolvió)
                if ($loan->returned_at) {
                    GateLog::updateOrCreate(
                        ['asset_id' => $loan->asset_id, 'logged_at' => $loan->returned_at, 'action' => 'entrada'],
                        [
                            'user_id'     => $loan->user_id,
                            'action'      => 'entrada',
                            'logged_at'   => $loan->returned_at,
                            'notes'       => 'Activo devuelto y reingresado correctamente.',
                            'created_by'  => $portero?->id,
                            'updated_by'  => $portero?->id,
                        ]
                    );
                }
            }
        }
    }
}
