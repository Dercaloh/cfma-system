<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\Program;
use App\Models\Position;
use App\Models\Department;
use App\Models\ProxyType;
use App\Models\Branch;
use Illuminate\Database\Seeder;

class LoanDetailsTableSeeder extends Seeder
{
    public function run(): void
    {
        $programas   = Program::pluck('id')->toArray();
        $departments = Department::pluck('id')->toArray();
        $positions   = Position::pluck('id')->toArray();
        $proxyTypes  = ProxyType::pluck('id')->toArray();
        $branches    = Branch::pluck('id')->toArray();

        $contador = 0;

        foreach (Loan::all() as $loan) {
            $contador++;

            $isFormativo = $contador % 2 === 0;

            LoanDetail::updateOrCreate(
                ['loan_id' => $loan->id],
                [
                    'tipo_de_uso'          => $isFormativo ? 'formativo' : 'administrativo',
                    'fecha_entrega_deseada'=> now()->addDays(rand(1, 3)),
                    'ficha'                => $isFormativo ? '2612345' : null,
                    'instructor'           => $isFormativo ? 'Instructor Gómez' : null,
                    'program_id'           => $isFormativo ? fake()->randomElement($programas) : null,
                    'position_id'          => fake()->randomElement($positions),
                    'department_id'        => fake()->randomElement($departments),
                    'proxy_type_id'        => $contador % 3 === 0 ? fake()->randomElement($proxyTypes) : null,
                    'branch_id'            => fake()->randomElement($branches),
                    'reclamado_por_apoderado' => $contador % 3 === 0,
                    'nombre_apoderado'     => $contador % 3 === 0 ? fake()->name() : null,
                    'documento_apoderado'  => $contador % 3 === 0 ? fake()->numerify('10########') : null,
                    'hora_entrega'         => now()->setTime(rand(7, 10), [0, 15, 30, 45][rand(0, 3)]),
                    'cantidad'             => 1,
                    'dias_solicitados'     => rand(1, 5),
                    'modalidad_entrega'    => $contador % 4 === 0 ? 'delegado' : 'presencial',
                    'proposito'            => $isFormativo ? 'Práctica formativa de software' : 'Soporte técnico',
                    'created_at'           => now(),
                    'updated_at'           => now(),
                ]
            );
        }
    }
}
