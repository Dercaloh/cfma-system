<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProxyTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $proxyTypes = [
            [
                'name' => 'Vocero',
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Vocero Suplente',
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Monitor Académico',
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Aprendiz Practicante',
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Apoderado Legal',
                'active' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('proxy_types')->insert($proxyTypes);
    }
}
