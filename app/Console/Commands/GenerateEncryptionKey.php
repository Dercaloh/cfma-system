<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Defuse\Crypto\Key;
use Illuminate\Support\Facades\File;

class GenerateEncryptionKey extends Command
{
    protected $signature = 'sgpti:generate-encryption-key';
    protected $description = 'Genera una nueva clave de cifrado APP_ENCRYPTION_KEY y la guarda en el archivo .env';

    public function handle(): int
    {
        // 1. Verificar si ya existe una clave
        $envPath = base_path('.env');
        $envContent = File::exists($envPath) ? File::get($envPath) : '';

        if (preg_match('/^APP_ENCRYPTION_KEY=(.+)$/m', $envContent, $matches)) {
            $this->warn('⚠ Ya existe una clave APP_ENCRYPTION_KEY en el archivo .env.');
            $this->line('Clave actual: ' . substr($matches[1], 0, 20) . '...');

            if (!$this->confirm('¿Deseas sobrescribirla?', false)) {
                $this->info('Operación cancelada.');
                return Command::SUCCESS;
            }

            // Remover la línea anterior
            $envContent = preg_replace('/^APP_ENCRYPTION_KEY=.+$/m', '', $envContent);
        }

        // 2. Generar nueva clave segura
        $newKey = Key::createNewRandomKey()->saveToAsciiSafeString();

        // 3. Añadir la nueva clave
        $envContent .= PHP_EOL . "APP_ENCRYPTION_KEY={$newKey}";

        File::put($envPath, trim($envContent) . PHP_EOL);

        $this->info('✅ Clave de cifrado generada correctamente.');
        $this->line("Nueva clave: <fg=yellow>{$newKey}</>");

        return Command::SUCCESS;
    }
}
