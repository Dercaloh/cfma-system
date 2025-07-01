<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Database\Seeder;

class SignaturesTableSeeder extends Seeder
{
    public function run(): void
    {
        $portero = User::whereHas('role', fn ($q) => $q->where('name', 'Portería'))->first();

        foreach (Loan::all() as $loan) {
            // Firma de entrega (cuando ya fue entregado)
            if ($loan->delivered_at) {
                Signature::updateOrCreate(
                    ['loan_id' => $loan->id, 'type' => 'entrega'],
                    [
                        'signed_by_user_id' => $loan->user_id, // quien recibe
                        'witness_user_id'   => $portero?->id,  // quien entrega (portería)
                        'signed_at'         => $loan->delivered_at,
                        'type'              => 'entrega',
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ]
                );
            }

            // Firma de devolución simulada en algunos casos
            if ($loan->status->name === 'Devuelto' || $loan->delivered_at && rand(0, 1)) {
                Signature::updateOrCreate(
                    ['loan_id' => $loan->id, 'type' => 'devolucion'],
                    [
                        'signed_by_user_id' => $loan->user_id, // quien devuelve
                        'witness_user_id'   => $portero?->id,  // quien recibe
                        'signed_at'         => now()->addDays(rand(1, 5)),
                        'type'              => 'devolucion',
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ]
                );
            }
        }
    }
}
