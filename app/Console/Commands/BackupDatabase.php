<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BackupDatabase extends Command
{
    protected $signature = 'backup:db';
    protected $description = 'Realiza un respaldo de la base de datos MySQL';

    public function handle()
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host     = config('database.connections.mysql.host');
        $port     = config('database.connections.mysql.port');

        $backupPath = storage_path('backups');
        File::ensureDirectoryExists($backupPath);

        $filename = $backupPath . '/' . $database . '_' . now()->format('Ymd_His') . '.sql';

        $command = "mysqldump -u{$username} -p\"{$password}\" -h {$host} -P {$port} {$database} > \"{$filename}\"";

        $result = null;
        system($command, $result);

        if ($result === 0) {
            $this->info("✅ Backup exitoso: {$filename}");
        } else {
            $this->error("❌ Error al crear backup.");
        }
    }
}
