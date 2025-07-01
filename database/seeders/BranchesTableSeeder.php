<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $userId = 1; // ID del usuario que crea los registros (ajustar si aplica)

        $branches = [
            [
                'name' => 'Sede Principal El Bagre',
                'location_code' => 'CO',
                'location_id' => 1,
                'active' => true,
            ],
            [
                'name' => 'Sede Alterna El Bagre',
                'location_code' => 'CO',
                'location_id' => 1,
                'active' => true,
            ],
            [
                'name' => 'Sede Virtual',
                'location_code' => null,
                'location_id' => null,
                'active' => true,
            ],
            [
                'name' => 'Formación Extramural – Barrios El Bagre',
                'location_code' => 'CO',
                'location_id' => 1,
                'active' => true,
            ],
            [
                'name' => 'Formación Extramural – Zonas Rurales El Bagre',
                'location_code' => 'CO',
                'location_id' => 1,
                'active' => true,
            ],
            [
                'name' => 'Punto de Formación – Caucasia',
                'location_code' => 'CO',
                'location_id' => 1,
                'active' => true,
            ],
            [
                'name' => 'Punto de Formación – Zaragoza',
                'location_code' => 'CO',
                'location_id' => 1,
                'active' => true,
            ],
            [
                'name' => 'Punto de Formación – Nechí',
                'location_code' => 'CO',
                'location_id' => 1,
                'active' => true,
            ],
            [
                'name' => 'Punto de Formación – Segovia',
                'location_code' => 'CO',
                'location_id' => 1,
                'active' => true,
            ],
            [
                'name' => 'Punto de Formación – Tarazá',
                'location_code' => 'CO',
                'location_id' => 1,
                'active' => true,
            ],
        ];

        foreach ($branches as &$branch) {
            $branch['created_by'] = $userId;
            $branch['created_at'] = $now;
            $branch['updated_at'] = $now;
        }

        DB::table('branches')->insert($branches);
    }
}
