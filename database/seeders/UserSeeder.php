<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $defaultPassword = Config::get('app.admin_password', 'admin123');

        User::updateOrCreate(
            ['email' => 'admin@cfma.local'],
            [
                'name' => 'Administrador CFMA',
                'password' => Hash::make($defaultPassword),
                'role_id' => 1,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
