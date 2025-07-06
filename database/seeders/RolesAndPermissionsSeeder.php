<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permisos base
        $permisos = [
            'gestionar usuarios',
            'gestionar activos',
            'gestionar préstamos',
            'ver reportes',
            'solicitar préstamos',
            'autorizar salidas de activos',
            'reclamar préstamos como apoderado',
            'modificar perfil',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }

        // Roles institucionales
        $roles = [
            ['name' => 'Administrador', 'description' => 'Acceso total al sistema (nivel técnico TI)...', 'level' => 0, 'permisos' => Permission::all()],
            ['name' => 'Subdirector', 'description' => 'Apoyo en dirección operativa. Supervisa coordinaciones y proyectos especiales.', 'level' => 1, 'permisos' => ['ver reportes']],
            ['name' => 'Coordinador', 'description' => 'Líder de área formativa: diseño curricular, instructores y seguimiento a programas.', 'level' => 2, 'permisos' => ['ver reportes']],
            ['name' => 'Instructor', 'description' => 'Facilitador técnico-pedagógico. Ejecuta formación, evalúa competencias y guía proyectos.', 'level' => 3, 'permisos' => ['solicitar préstamos', 'autorizar salidas de activos', 'reclamar préstamos como apoderado']],
            ['name' => 'Gestor Administrativo', 'description' => 'Apoyo logístico: matrículas, bienestar, recursos físicos y proveedores.', 'level' => 4, 'permisos' => ['solicitar préstamos', 'autorizar salidas de activos', 'reclamar préstamos como apoderado']],
            ['name' => 'Portería/Vigilancia', 'description' => 'Control de accesos, seguridad perimetral y registro de visitas.', 'level' => 5, 'permisos' => []],
            ['name' => 'Vocero Principal', 'description' => 'Representante estudiantil ante consejos directivos. Canaliza iniciativas de aprendices.', 'level' => 6, 'permisos' => ['reclamar préstamos como apoderado']],
            ['name' => 'Vocero Suplente', 'description' => 'Apoyo al vocero principal y suplencia en ausencias.', 'level' => 7, 'permisos' => ['reclamar préstamos como apoderado']],
            ['name' => 'Aprendiz', 'description' => 'Beneficiario de formación. Acceso limitado a plataformas educativas y autogestión.', 'level' => 8, 'permisos' => ['modificar perfil']],
        ];

        foreach ($roles as $data) {
            $role = Role::updateOrCreate(
                ['name' => $data['name'], 'guard_name' => 'web'],
                ['description' => $data['description'], 'level' => $data['level']]
            );

            $permisos = collect($data['permisos'])->map(function ($p) {
                return is_string($p) ? Permission::where('name', $p)->first() : $p;
            })->filter()->pluck('name')->toArray();

            $role->syncPermissions($permisos);
        }
    }
}
