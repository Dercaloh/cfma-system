<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Ejecutar todos los seeders base del sistema SGPTI.
     */
    public function run(): void
{

    $this->call(CoreCatalogsSeeder::class);
    $this->call(SecurityUsersSeeder::class);
    $this->call(AssetSeeder::class);

}


}
