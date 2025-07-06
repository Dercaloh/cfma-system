<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\{Department, Position, Branch, Program, Location, User};

class NormalizeText extends Command
{
    protected $signature = 'normalize:text {--user= : ID del usuario que ejecuta la normalización}';
    protected $description = 'Normaliza campos de texto a formato Title Case y actualiza auditoría';

    public function handle()
    {
        $userId = $this->option('user') ?? 'system';

        $this->normalizeModel(Department::class, ['name'], $userId);
        $this->normalizeModel(Position::class, ['title'], $userId);
        $this->normalizeModel(Branch::class, ['name'], $userId);
        $this->normalizeModel(Program::class, ['name'], $userId);
        $this->normalizeModel(Location::class, ['name'], $userId);
        $this->normalizeModel(User::class, ['first_name', 'last_name'], $userId);

        $this->info('✅ Todos los campos fueron normalizados correctamente.');
    }

    protected function normalizeModel(string $modelClass, array $fields, $userId): void
    {
        $modelName = class_basename($modelClass);
        $this->info("→ {$modelName}");

        $modelClass::withoutEvents(function () use ($modelClass, $fields, $userId, $modelName) {
            $modelClass::all()->each(function ($record) use ($fields, $userId, $modelName) {
                $changed = false;

                foreach ($fields as $field) {
                    if (!isset($record->$field)) continue;

                    $original = $record->$field;
                    $normalized = Str::title(Str::lower(trim($original)));

                    if ($original !== $normalized) {
                        $record->$field = $normalized;
                        $changed = true;
                        $this->line("  • ID {$record->id}: '{$original}' ➜ '{$normalized}'");
                    }
                }

                if ($changed) {
                    if (Schema::hasColumn($record->getTable(), 'updated_by')) {
                        $record->updated_by = $userId;
                    }

                    $record->saveQuietly();
                }
            });
        });
    }
}
