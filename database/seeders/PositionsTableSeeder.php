<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            // 1. Personal Administrativo y de Apoyo
            'APOYO DE ALMACÉN',
            'APOYO DE BIBLIOTECA',
            'TÉCNICO EN GESTIÓN DOCUMENTAL',
            'ANALISTA DE SOPORTE TIC',
            'APOYO CONTABLE',
            'PROFESIONAL DE RRHH',

            // 2. Cuerpo Instructivo
            'INSTRUCTOR TITULADA',
            'INSTRUCTOR MEDIA TÉCNICA',
            'INSTRUCTOR VIRTUAL',
            'INSTRUCTOR CAMPESENA',
            'INSTRUCTOR COMPLEMENTARIO',
            'EVALUADOR DE COMPETENCIAS LABORALES',

            // 3. Liderazgo y Coordinación
            'COORDINADOR ACADÉMICO',
            'LÍDER DE BIENESTAR AL APRENDIZ',
            'SUBDIRECTOR DE CENTRO',
            'COORDINADOR ADMINISTRATIVO Y FINANCIERO','COORDINADOR DE FORMACION',

            // 4. Roles Especializados
            'PSICÓLOGO(A)',
            'DINAMIZADOR',
            'INGENIERO CIVIL',
            'PROFECIONAL',

            // 5. Servicios Generales (internos)
            'APOYO DE ATENCIÓN AL CIUDADANO',

            // 6. Roles de Aprendices (aplicados en seguimiento de roles)
            'APRENDIZ TITULADO',
            'APRENDIZ DE MEDIA TÉCNICA',
            'APRENDIZ PRACTICANTE',
            'MONITOR ACADÉMICO',
            'VOCERO DE APRENDICES',
        ];

        foreach ($positions as $title) {
            DB::table('positions')->updateOrInsert(
                ['title' => $title],
                [
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
