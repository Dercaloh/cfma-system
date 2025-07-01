<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AssetsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Asegúrate de tener AssetTypes previamente sembrados
        $types = AssetType::all();
        $users = User::where('status', 'activo')->get();

        $activos = [
            ['Laptop HP ProBook', 'Centro', 'Disponible', 'Bueno'],
            ['Impresora Epson L3110', 'Centro', 'Disponible', 'Bueno'],
            ['Tablet Samsung Galaxy', 'Centro', 'Prestado', 'Regular'],
            ['Switch TP-Link 24p', 'Centro', 'Disponible', 'Bueno'],
            ['Monitor LG 24"', 'Centro', 'En mantenimiento', 'Dañado'],
            ['Proyector BenQ MX550', 'Centro', 'Disponible', 'Bueno'],
            ['Portátil Lenovo ThinkPad', 'Personal', 'Prestado', 'Bueno'],
            ['PC de Escritorio Dell', 'Centro', 'Retirado', 'En diagnóstico'],
        ];

        foreach ($activos as $i => [$nombre, $ownership, $status, $condition]) {
            $type = $types->random();
            $assignedTo = $status === 'Prestado' ? $users->random()?->id : null;

            Asset::create([
                'name' => $nombre,
                'serial_number' => strtoupper(Str::random(10)),
                'placa' => 'INV-' . str_pad((string)($i + 1), 5, '0', STR_PAD_LEFT),
                'type_id' => $type->id,
                'ownership' => $ownership,
                'brand' => fake()->company(),
                'model' => fake()->bothify('##??'),
                'os' => fake()->randomElement(['Windows 10', 'Ubuntu 22.04', 'Windows 11', null]),
                'year_purchased' => now()->year - rand(0, 5),
                'status' => $status,
                'condition' => $condition,
                'location' => fake()->randomElement(['Almacén', 'Con usuario', 'En préstamo', 'Otro']),
                'loanable' => $status !== 'Retirado',
                'movable' => $ownership === 'Personal',
                'assigned_to' => $assignedTo,
                'description' => fake()->sentence(),
                'mac_address' => fake()->unique()->macAddress(),
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
