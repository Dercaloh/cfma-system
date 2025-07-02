<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CoreCatalogsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $createdBy = 1;

        /** Roles */
        DB::table('roles')->insert([
            ['name' => 'Administrador',         'description' => 'Acceso root total al sistema', 'level' => 0],
            ['name' => 'Subdirector',           'description' => 'Administrador del centro sin acceso root', 'level' => 1],
            ['name' => 'Coordinador',           'description' => 'Supervisor de áreas académicas o formativas', 'level' => 2],
            ['name' => 'Funcionario',           'description' => 'Instructores, administrativos y contratistas', 'level' => 3],
            ['name' => 'Portería',              'description' => 'Encargado de registrar entradas y salidas', 'level' => 4],
            ['name' => 'Vocero',                'description' => 'Representante estudiantil principal', 'level' => 5],
            ['name' => 'Vocero Suplente',       'description' => 'Sustituto del vocero principal', 'level' => 6],
            ['name' => 'Aprendiz',              'description' => 'Rol de formación, sin privilegios administrativos', 'level' => 7],
        ]);

        /** Permisos */
        $permissions = [
            'view_users' => 'Ver usuarios del sistema',
            'create_users' => 'Crear nuevos usuarios',
            'edit_users' => 'Editar usuarios existentes',
            'delete_users' => 'Eliminar usuarios del sistema',
            'view_roles' => 'Ver roles del sistema',
            'assign_roles' => 'Asignar roles a usuarios',
            'manage_permissions' => 'Administrar permisos del sistema',
            'view_assets' => 'Ver activos registrados',
            'create_assets' => 'Registrar nuevos activos',
            'edit_assets' => 'Editar activos existentes',
            'delete_assets' => 'Eliminar activos del inventario',
            'view_loans' => 'Consultar préstamos de activos',
            'create_loans' => 'Registrar solicitud de préstamo',
            'approve_loans' => 'Aprobar o rechazar solicitudes',
            'deliver_loans' => 'Entregar activos en préstamo',
            'receive_loans' => 'Registrar devolución de activos',
            'sign_loan_delivery' => 'Firmar entrega de préstamo',
            'sign_loan_return' => 'Firmar devolución de préstamo',
            'upload_documents' => 'Subir documentos asociados',
            'view_documents' => 'Ver documentos registrados',
            'log_gate_entry' => 'Registrar entrada de activo',
            'log_gate_exit' => 'Registrar salida de activo',
            'generate_exit_pass' => 'Generar pase de salida',
            'view_audit_logs' => 'Ver registros de auditoría',
            'configure_system' => 'Configurar parámetros del sistema',
        ];

        foreach ($permissions as $key => $desc) {
            DB::table('permissions')->insert([
                'name' => $key,
                'description' => $desc,
                'created_by' => $createdBy,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        /** Departamentos */
        $departments = [
            'COORDINACIÓN ACADÉMICA',
            'COORDINACIÓN ADMINISTRATIVA Y FINANCIERA',
            'COORDINACIÓN DE PROGRAMAS ESPECIALES',
            'SUBDIRECCIÓN DE CENTRO',
            'BIBLIOTECA',
            'ALMACÉN',
            'SERVICIOS GENERALES',
            'GESTIÓN DOCUMENTAL (ARCHIVO)',
            'SISTEMAS (TIC)',
            'BIENESTAR AL APRENDIZ',
            'CONTRATACIÓN',
            'INVENTARIO Y CONTABILIDAD',
            'TESORERÍA',
            'PRESUPUESTO',
            'PLANEACIÓN',
            'SENNOVA (INNOVACIÓN Y TECNOLOGÍA)',
            'EVALUACIÓN Y CERTIFICACIÓN',
            'EMPLEO Y EMPRENDIMIENTO',
            'SISTEMA DE GESTIÓN (SIGA / SOFIA PLUS)',
        ];

        foreach ($departments as $name) {
            DB::table('departments')->updateOrInsert(
                ['name' => $name],
                [
                    'active' => true,
                    'created_by' => $createdBy,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        /** Cargos */
        $positions = [
            'APOYO DE ALMACÉN', 'APOYO DE BIBLIOTECA', 'TÉCNICO EN GESTIÓN DOCUMENTAL',
            'ANALISTA DE SOPORTE TIC', 'APOYO CONTABLE', 'PROFESIONAL DE RRHH',
            'INSTRUCTOR TITULADA', 'INSTRUCTOR MEDIA TÉCNICA', 'INSTRUCTOR VIRTUAL',
            'INSTRUCTOR CAMPESENA', 'INSTRUCTOR COMPLEMENTARIO', 'EVALUADOR DE COMPETENCIAS LABORALES',
            'COORDINADOR ACADÉMICO', 'LÍDER DE BIENESTAR AL APRENDIZ', 'SUBDIRECTOR DE CENTRO',
            'COORDINADOR ADMINISTRATIVO Y FINANCIERO', 'COORDINADOR DE FORMACION',
            'PSICÓLOGO(A)', 'DINAMIZADOR', 'INGENIERO CIVIL', 'PROFESIONAL',
            'APOYO DE ATENCIÓN AL CIUDADANO',
            'APRENDIZ TITULADO', 'APRENDIZ DE MEDIA TÉCNICA', 'APRENDIZ PRACTICANTE',
            'MONITOR ACADÉMICO', 'VOCERO DE APRENDICES',
        ];

        foreach ($positions as $title) {
            DB::table('positions')->updateOrInsert(
                ['title' => $title],
                [
                    'active' => true,
                    'created_by' => $createdBy,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        /** Tipos de apoderado */
        DB::table('proxy_types')->insert([
            ['name' => 'Vocero', 'active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Vocero Suplente', 'active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Monitor Académico', 'active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Aprendiz Practicante', 'active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Apoderado Legal', 'active' => false, 'created_at' => $now, 'updated_at' => $now],
        ]);

        /** Ubicaciones (locations) */
        $locations = [
            ['name' => 'El Bagre - Sede Principal',     'description' => 'Ubicación principal en El Bagre'],
            ['name' => 'Almacén Central',               'description' => 'Ubicación del inventario y despacho de activos'],
            ['name' => 'Portería Principal',            'description' => 'Registro de entradas y salidas de activos físicos'],
            ['name' => 'Zona de Prestamista (Aprendiz)', 'description' => 'Área de entrega y devolución de activos al aprendiz'],
            ['name' => 'Sala de Tecnología',            'description' => 'Zona de uso temporal de equipos TI'],
            ['name' => 'Oficina de Sistemas (TIC)',     'description' => 'Área de soporte técnico y mantenimiento'],
            ['name' => 'Depósito Temporal',             'description' => 'Lugar de activos en tránsito o reparación'],
            ['name' => 'Bodega de Software Licenciado', 'description' => 'Almacenamiento lógico de licencias y software'],
            ['name' => 'Zona de Reciclaje Tecnológico', 'description' => 'Área de baja y disposición final de activos TI'],
            ['name' => 'Laboratorio de Hardware',       'description' => 'Espacio técnico para pruebas y reparaciones'],
        ];

        foreach ($locations as $loc) {
            DB::table('locations')->updateOrInsert(
                ['name' => $loc['name']],
                [
                    'description' => $loc['description'],
                    'active' => true,
                    'created_by' => $createdBy,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        /** Sedes (branches) */
        $defaultLocationId = DB::table('locations')
            ->where('name', 'El Bagre - Sede Principal')
            ->value('id');

        $branches = [
            'Sede Principal El Bagre',
            'Sede Alterna El Bagre',
            'Sede Virtual',
            'Formación Extramural – Barrios El Bagre',
            'Formación Extramural – Zonas Rurales El Bagre',
            'Punto de Formación – Caucasia',
            'Punto de Formación – Zaragoza',
            'Punto de Formación – Nechí',
            'Punto de Formación – Segovia',
            'Punto de Formación – Tarazá',
        ];

        foreach ($branches as $name) {
            DB::table('branches')->updateOrInsert(
                ['name' => $name],
                [
                    'location_id' => $defaultLocationId,
                    'location_code' => 'CO',
                    'active' => true,
                    'created_by' => $createdBy,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
