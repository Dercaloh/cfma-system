<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RolePermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $adminId = 1; // ID del usuario root que crea las asignaciones

        // Definición de permisos por rol
        $rolePermissions = [
            'Administrador' => [
                'view_users', 'create_users', 'edit_users', 'delete_users',
                'view_roles', 'assign_roles', 'manage_permissions',
                'view_assets', 'create_assets', 'edit_assets', 'delete_assets',
                'view_loans', 'create_loans', 'approve_loans', 'deliver_loans', 'receive_loans',
                'sign_loan_delivery', 'sign_loan_return',
                'upload_documents', 'view_documents',
                'log_gate_entry', 'log_gate_exit', 'generate_exit_pass',
                'view_audit_logs', 'configure_system',
            ],
            'Subdirector' => [
                'view_users', 'view_roles',
                'view_assets',
                'view_loans', 'approve_loans',
                'view_documents',
                'view_audit_logs',
            ],
            'Coordinador' => [
                'view_assets', 'create_assets', 'edit_assets',
                'view_loans', 'create_loans', 'approve_loans',
                'sign_loan_delivery', 'sign_loan_return',
                'upload_documents', 'view_documents',
            ],
            'Funcionario' => [
                'view_assets',
                'view_loans', 'create_loans',
                'sign_loan_delivery', 'sign_loan_return',
            ],
            'Portería' => [
                'log_gate_entry', 'log_gate_exit', 'generate_exit_pass',
            ],
            'Aprendiz' => [
                'view_loans', 'create_loans',
                'sign_loan_delivery', 'sign_loan_return',
            ],
        ];

        // Obtener IDs reales de roles y permisos
        $roleIds = DB::table('roles')->pluck('id', 'name');         // [ 'Administrador' => 1, ... ]
        $permissionIds = DB::table('permissions')->pluck('id', 'name'); // [ 'view_users' => 1, ... ]

        $data = [];

        foreach ($rolePermissions as $roleName => $permissions) {
            $roleId = $roleIds[$roleName] ?? null;
            if (!$roleId) continue;

            foreach ($permissions as $permissionName) {
                $permissionId = $permissionIds[$permissionName] ?? null;
                if (!$permissionId) continue;

                $data[] = [
                    'role_id'       => $roleId,
                    'permission_id' => $permissionId,
                    'assigned_by'   => $adminId,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];
            }
        }

        DB::table('role_permission')->insert($data);
    }
}
