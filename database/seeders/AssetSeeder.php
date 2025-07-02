<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $createdBy = 1;

        // 1. Tipos de activo (hardware + software)
        $types = [
            'Computador de Escritorio',
            'Portátil',
            'Tablet',
            'Monitor',
            'Proyector',
            'Impresora',
            'Switch',
            'Router',
            'Servidor',
            'Cámara Web',
            'Mouse',
            'Teclado',
            'Software de Oficina',
            'Sistema Operativo',
            'Antivirus',
            'Otro',
        ];

        $typeIds = [];

        foreach ($types as $type) {
            $id = DB::table('asset_types')->insertGetId([
                'name' => $type,
                'description' => 'Tipo de activo: ' . $type,
                'active' => true,
                'created_by' => $createdBy,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $typeIds[$type] = $id;
        }

        // 2. Activos de hardware (con detalles técnicos)
        $hardwareAssets = [
            [
                'name' => 'PC Administración Principal',
                'serial_number' => 'ADM-HP-001',
                'inventory_code' => 'INV-HW-001',
                'brand' => 'HP',
                'model' => 'EliteDesk 800',
                'description' => 'Equipo de oficina para trámites administrativos',
                'type' => 'Computador de Escritorio',
            ],
            [
                'name' => 'Portátil Vocero Principal',
                'serial_number' => 'VOC-LEN-002',
                'inventory_code' => 'INV-HW-002',
                'brand' => 'Lenovo',
                'model' => 'ThinkPad L14',
                'description' => 'Equipo portátil asignado al representante estudiantil',
                'type' => 'Portátil',
            ],
            [
                'name' => 'Switch Cisco 24 Puertos',
                'serial_number' => 'SW-CISCO-01',
                'inventory_code' => 'INV-HW-003',
                'brand' => 'Cisco',
                'model' => 'SG350-28',
                'description' => 'Switch de red principal para aulas',
                'type' => 'Switch',
            ],
        ];

        foreach ($hardwareAssets as $i => $asset) {
            $assetId = DB::table('assets')->insertGetId([
                'name' => $asset['name'],
                'serial_number' => $asset['serial_number'],
                'inventory_code' => $asset['inventory_code'],
                'brand' => $asset['brand'],
                'model' => $asset['model'],
                'description' => $asset['description'],
                'asset_type_id' => $typeIds[$asset['type']],
                'status' => 'disponible',
                'branch_id' => 1,
                'location_id' => 1,
                'created_by' => $createdBy,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('asset_hardware_details')->insert([
                'asset_id' => $assetId,
                'cpu' => fake()->randomElement(['Intel i5', 'Intel i7', 'Ryzen 5']),
                'ram' => fake()->randomElement(['8GB', '16GB']),
                'storage' => fake()->randomElement(['256GB SSD', '1TB HDD']),
                'os' => fake()->randomElement(['Windows 10 Pro', 'Ubuntu 22.04', 'Windows 11 Home']),
                'mac_address' => Str::upper(Str::random(2)) . ':' . Str::upper(Str::random(2)) . ':' . Str::upper(Str::random(2)) . ':' . Str::upper(Str::random(2)) . ':' . Str::upper(Str::random(2)) . ':' . Str::upper(Str::random(2)),
                'created_by' => $createdBy,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 3. Activos de software (con licencias y versiones)
        $softwareAssets = [
            [
                'name' => 'Microsoft Office 365',
                'serial_number' => 'OFFICE-365-001',
                'inventory_code' => 'INV-SW-001',
                'brand' => 'Microsoft',
                'model' => 'Office 365 E3',
                'description' => 'Suite de ofimática para funcionarios',
                'type' => 'Software de Oficina',
            ],
            [
                'name' => 'Antivirus ESET NOD32',
                'serial_number' => 'ESET-NOD32-001',
                'inventory_code' => 'INV-SW-002',
                'brand' => 'ESET',
                'model' => 'NOD32 Antivirus',
                'description' => 'Antivirus institucional',
                'type' => 'Antivirus',
            ],
            [
                'name' => 'Windows 11 Pro',
                'serial_number' => 'WIN11-PRO-001',
                'inventory_code' => 'INV-SW-003',
                'brand' => 'Microsoft',
                'model' => 'Windows 11 Pro',
                'description' => 'Sistema operativo actualizado',
                'type' => 'Sistema Operativo',
            ],
        ];

        foreach ($softwareAssets as $asset) {
            $assetId = DB::table('assets')->insertGetId([
                'name' => $asset['name'],
                'serial_number' => $asset['serial_number'],
                'inventory_code' => $asset['inventory_code'],
                'brand' => $asset['brand'],
                'model' => $asset['model'],
                'description' => $asset['description'],
                'asset_type_id' => $typeIds[$asset['type']],
                'status' => 'disponible',
                'branch_id' => 1,
                'location_id' => 1,
                'created_by' => $createdBy,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('asset_software_details')->insert([
                'asset_id' => $assetId,
                'version' => fake()->randomElement(['v2023.1', 'v2024.0', 'v2025.2']),
                'license_key' => strtoupper(Str::random(5) . '-' . Str::random(5) . '-' . Str::random(5)),
                'licensed_to' => 'SENA CFMA',
                'license_type' => fake()->randomElement(['OEM', 'Volumen', 'Individual']),
                'expiration_date' => fake()->optional()->dateTimeBetween('now', '+2 years'),
                'created_by' => $createdBy,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
