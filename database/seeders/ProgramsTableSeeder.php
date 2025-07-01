<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramsTableSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            // Programas Tecnológicos
            ['name' => 'Tecnólogo en Gestión Administrativa', 'code' => '228106'],
            ['name' => 'Tecnólogo en Análisis y Desarrollo de Software', 'code' => '228106A'],
            ['name' => 'Tecnólogo en Electricidad Industrial', 'code' => '228104'],
            ['name' => 'Tecnólogo en Seguridad y Salud en el Trabajo', 'code' => '228108'],

            // Programas Técnicos
            ['name' => 'Técnico en Sistemas', 'code' => '123456'],
            ['name' => 'Técnico en Soldadura', 'code' => '123457'],
            ['name' => 'Técnico en Recursos Humanos', 'code' => '123458'],
            ['name' => 'Técnico en Contabilidad y Finanzas', 'code' => '123459'],

            // Media Técnica
            ['name' => 'Media Técnica en Sistemas', 'code' => 'MT-001'],
            ['name' => 'Media Técnica en Electricidad', 'code' => 'MT-002'],

            // Formación Virtual
            ['name' => 'Formación Virtual - Ética Profesional', 'code' => 'FV-001'],
            ['name' => 'Formación Virtual - Competencias Ciudadanas', 'code' => 'FV-002'],

            // Especiales o de Extensión
            ['name' => 'Programa ECCL - Educación para el Cambio Climático', 'code' => 'ECCL-001'],
            ['name' => 'Programa de Inclusión Rural y Poblaciones Especiales', 'code' => 'IRPE-001'],

            // Programas Ambientales y del CFMA
            ['name' => 'Tecnólogo en Control Ambiental', 'code' => 'CFMA-001'],
            ['name' => 'Técnico en Manejo Ambiental', 'code' => 'CFMA-002'],

            // Programas Extramurales en El Bagre y zona de influencia
            ['name' => 'Extramural - Técnico en Agroindustria Alimentaria', 'code' => 'EX-001'],
            ['name' => 'Extramural - Técnico en Construcción de Edificaciones', 'code' => 'EX-002'],
        ];

        foreach ($programs as $program) {
            DB::table('programs')->updateOrInsert(
                ['name' => $program['name']],
                [
                    'code' => $program['code'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
