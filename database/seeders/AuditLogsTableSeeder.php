<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AuditLogsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $admin       = User::whereHas('role', fn($q) => $q->where('name', 'Administrador'))->first();
        $coordinador = User::whereHas('role', fn($q) => $q->where('name', 'Coordinador'))->first();
        $aprendiz    = User::whereHas('role', fn($q) => $q->where('name', 'Aprendiz'))->first();
        $portero     = User::whereHas('role', fn($q) => $q->where('name', 'Portería'))->first();
        $subdirector = User::whereHas('role', fn($q) => $q->where('name', 'Subdirector'))->first();

        $logs = [
            [
                'user_id'     => $admin?->id,
                'action'      => 'create_user',
                'description' => 'Creación de nuevo usuario: claudia.velasquez@sgpti.local',
                'ip_address'  => '192.168.1.2',
            ],
            [
                'user_id'     => $coordinador?->id,
                'action'      => 'update_loan',
                'description' => 'Modificación de préstamo #1025 - fecha de devolución actualizada',
                'ip_address'  => '192.168.1.20',
            ],
            [
                'user_id'     => $aprendiz?->id,
                'action'      => 'sign_loan_delivery',
                'description' => 'Firma digital de entrega de activo #A215 - portátil Lenovo',
                'ip_address'  => '192.168.1.45',
            ],
            [
                'user_id'     => $portero?->id,
                'action'      => 'log_gate_exit',
                'description' => 'Registro de salida del activo #A215',
                'ip_address'  => '192.168.1.10',
            ],
            [
                'user_id'     => $subdirector?->id,
                'action'      => 'view_audit_logs',
                'description' => 'Visualización del módulo de auditoría del sistema',
                'ip_address'  => '192.168.1.5',
            ],
        ];

        foreach ($logs as $log) {
            AuditLog::create([
                ...$log,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
