<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $permissions = [
            // Gestión de usuarios
            ['name' => 'view_users',         'description' => 'Ver usuarios del sistema'],
            ['name' => 'create_users',       'description' => 'Crear nuevos usuarios'],
            ['name' => 'edit_users',         'description' => 'Editar usuarios existentes'],
            ['name' => 'delete_users',       'description' => 'Eliminar usuarios del sistema'],

            // Gestión de roles y permisos
            ['name' => 'view_roles',         'description' => 'Ver roles del sistema'],
            ['name' => 'assign_roles',       'description' => 'Asignar roles a usuarios'],
            ['name' => 'manage_permissions', 'description' => 'Administrar permisos del sistema'],

            // Activos TI
            ['name' => 'view_assets',        'description' => 'Ver activos registrados'],
            ['name' => 'create_assets',      'description' => 'Registrar nuevos activos'],
            ['name' => 'edit_assets',        'description' => 'Editar activos existentes'],
            ['name' => 'delete_assets',      'description' => 'Eliminar activos del inventario'],

            // Préstamos
            ['name' => 'view_loans',         'description' => 'Consultar préstamos de activos'],
            ['name' => 'create_loans',       'description' => 'Registrar solicitud de préstamo'],
            ['name' => 'approve_loans',      'description' => 'Aprobar o rechazar solicitudes'],
            ['name' => 'deliver_loans',      'description' => 'Entregar activos en préstamo'],
            ['name' => 'receive_loans',      'description' => 'Registrar devolución de activos'],

            // Firmas electrónicas
            ['name' => 'sign_loan_delivery', 'description' => 'Firmar entrega de préstamo'],
            ['name' => 'sign_loan_return',   'description' => 'Firmar devolución de préstamo'],

            // Documentos
            ['name' => 'upload_documents',   'description' => 'Subir documentos asociados'],
            ['name' => 'view_documents',     'description' => 'Ver documentos registrados'],

            // Portería
            ['name' => 'log_gate_entry',     'description' => 'Registrar entrada de activo'],
            ['name' => 'log_gate_exit',      'description' => 'Registrar salida de activo'],
            ['name' => 'generate_exit_pass', 'description' => 'Generar pase de salida'],

            // Auditoría
            ['name' => 'view_audit_logs',    'description' => 'Ver registros de auditoría'],

            // Administración general
            ['name' => 'configure_system',   'description' => 'Configurar parámetros del sistema'],
        ];

        foreach ($permissions as &$permission) {
            $permission['created_at'] = $now;
            $permission['updated_at'] = $now;
            $permission['created_by'] = 1; // usuario root por defecto
        }

        DB::table('permissions')->insert($permissions);
    }
}
