<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            // Núcleo formativo y académico
            'COORDINACIÓN ACADÉMICA',
            'COORDINACIÓN ADMINISTRATIVA Y FINANCIERA',
            'COORDINACIÓN DE PROGRAMAS ESPECIALES',
            'SUBDIRECCIÓN DE CENTRO',

            // Apoyo a la formación
            'BIBLIOTECA',
            'ALMACÉN',
            'SERVICIOS GENERALES',
            'GESTIÓN DOCUMENTAL (ARCHIVO)',
            'SISTEMAS (TIC)',
            'BIENESTAR AL APRENDIZ',

            // Apoyo administrativo
            'CONTRATACIÓN',
            'INVENTARIO Y CONTABILIDAD',
            'TESORERÍA',
            'PRESUPUESTO',
            'PLANEACIÓN',
            'SENNOVA (INNOVACIÓN Y TECNOLOGÍA)',

            // Gestión externa y certificación
            'EVALUACIÓN Y CERTIFICACIÓN',
            'EMPLEO Y EMPRENDIMIENTO',
            'SISTEMA DE GESTIÓN (SIGA / SOFIA PLUS)',
        ];

        foreach ($departments as $name) {
            DB::table('departments')->updateOrInsert(
                ['name' => $name],
                [
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
