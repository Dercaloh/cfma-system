<?php

namespace Database\Seeders;

use App\Models\ExitPass;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExitPassesTableSeeder extends Seeder
{
    public function run(): void
    {
        $portero = User::whereHas('role', fn ($q) => $q->where('name', 'Portería'))->first();

        foreach (Loan::with('asset')->get() as $loan) {
            if ($loan->delivered_at && $loan->asset->movable) {

                ExitPass::updateOrCreate(
                    ['loan_id' => $loan->id],
                    [
                        'user_id'       => $loan->user_id,         // quien transporta el activo
                        'generated_by'  => $portero?->id,          // quien autoriza
                        'generated_at'  => $loan->delivered_at,    // mismo día de entrega
                        'code'          => strtoupper(Str::random(8)), // código único
                        'reason'        => 'Préstamo temporal de equipo institucional.',
                        'observations'  => 'Salida autorizada para actividades académicas.',
                        'status'        => 'autorizado',
                        'created_by'    => $portero?->id,
                        'updated_by'    => $portero?->id,
                    ]
                );
            }
        }
    }
}
