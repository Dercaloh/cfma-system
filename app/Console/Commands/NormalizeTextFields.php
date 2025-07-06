<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Department;
use App\Models\Position;
use App\Models\Branch;
use App\Models\Program;
use App\Models\Location;

class NormalizeTextFields extends Command
{
    /**
     * Firma del comando
     */
    protected $signature = 'normalize:text {--user= : ID del usuario que ejecuta la normalización}';

    /**
     * Descripción del comando
     */
    protected $description = 'Normaliza campos de texto a formato Title Case en modelos clave y registra auditoría.';

    /**
     * Ejecución del comando
     */
    public function handle(): void
    {
        $userId = $this->option('user') ?? 'system';

        $this->normalizeModel(Department::class, 'name', $userId);
        $this->normalizeModel(Position::class, 'title', $userId);
        $this->normalizeModel(Branch::class, 'name', $userId);
        $this->normalizeModel(Program::class, 'name', $userId);
        $this->normalizeModel(Location::class, 'name', $userId);

        $this->info('✔ Todos los campos han sido normalizados correctamente.');
    }

    /**
     * Normaliza los campos indicados en el modelo
     */
    protected function normalizeModel(string $modelClass, string $attribute, $userId): void
    {
        $modelName = class_basename($modelClass);
        $this->info("→ Normalizando: {$modelName}");

        $modelClass::withoutEvents(function () use ($modelClass, $attribute, $userId, $modelName) {
            $records = $modelClass::all();

            foreach ($records as $record) {
                $original = $record->$attribute;
                $normalized = Str::title(Str::lower(trim($original)));

                if ($original !== $normalized) {
                    $record->$attribute = $normalized;

                    // Si el modelo tiene campo updated_by, lo actualizamos
                    if (Schema::hasColumn($record->getTable(), 'updated_by')) {
                        $record->updated_by = $userId;
                    }

                    $record->saveQuietly();

                    $this->line("✔ {$modelName} [ID: {$record->id}] → '{$original}' ⇒ '{$normalized}'");
                }
            }
        });
    }
}
