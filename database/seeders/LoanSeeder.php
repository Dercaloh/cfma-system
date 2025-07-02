<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\LoanRequestData;
use App\Models\LoanApproval;
use App\Models\Signature;
use App\Models\User;
use App\Models\Asset;
use App\Models\LoanStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Asegúrate de tener datos de referencia
            $users       = User::inRandomOrder()->take(5)->get();
            $assets      = Asset::inRandomOrder()->take(5)->get();
            $statuses    = LoanStatus::pluck('id')->all();
            $admin       = User::where('email', 'admin@example.com')->first();

            foreach (range(1, 5) as $i) {
                $user       = $users->random();
                $asset      = $assets->random();
                $status_id  = collect($statuses)->random();

                $loan = Loan::create([
                    'user_id'       => $user->id,
                    'asset_id'      => $asset->id,
                    'status_id'     => $status_id,
                    'approved_by'   => $admin?->id,
                    'delivered_by'  => $admin?->id,
                    'received_by'   => $admin?->id,
                    'requested_at'  => now()->subDays(rand(5, 10)),
                    'approved_at'   => now()->subDays(rand(3, 5)),
                    'delivered_at'  => now()->subDays(rand(2, 4)),
                    'returned_at'   => now()->subDays(rand(0, 2)),
                    'notes'         => fake()->sentence(),
                    'created_by'    => $admin?->id,
                    'updated_by'    => $admin?->id,
                ]);

                LoanDetail::create([
                    'loan_id'         => $loan->id,
                    'cantidad'        => 1,
                    'dias_solicitados'=> rand(1, 5),
                    'modalidad_entrega'=> 'presencial',
                    'hora_entrega'    => '09:00:00',
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);

                LoanRequestData::create([
                    'loan_id'             => $loan->id,
                    'tipo_de_uso'         => 'formativo',
                    'program_id'          => null,
                    'instructor_id'       => $admin?->id,
                    'proposito'           => 'Préstamo para práctica de redes',
                    'department_id'       => null,
                    'position_id'         => null,
                    'branch_id'           => null,
                    'fecha_entrega_deseada'=> now()->addDays(1)->toDateString(),
                    'reclamado_por_apoderado' => false,
                    'nombre_apoderado'    => null,
                    'documento_apoderado' => null,
                    'proxy_type_id'       => null,
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);

                LoanApproval::create([
                    'loan_id'     => $loan->id,
                    'decided_by'  => $admin?->id,
                    'status'      => 'aprobado',
                    'justification' => 'Revisado y aprobado por coordinación',
                    'approved_at' => now()->subDays(3),
                    'created_by'  => $admin?->id,
                    'updated_by'  => $admin?->id,
                ]);

                Signature::create([
                    'loan_id'         => $loan->id,
                    'user_id'         => $admin?->id,
                    'type'            => 'entrega',
                    'signature_blob'  => Str::random(128), // Reemplaza con blob real en producción
                    'signature_hash'  => hash('sha256', 'firma_ficticia'),
                    'signed_at'       => now()->subDays(2),
                    'observacion'     => 'Activo entregado sin novedades.',
                    'created_by'      => $admin?->id,
                    'updated_by'      => $admin?->id,
                ]);
            }
        });
    }
}

