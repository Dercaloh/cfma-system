<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración: crea la tabla `documents` con relaciones polimórficas.
     *
     * - Asociable a múltiples entidades (activos, préstamos, etc.).
     * - Incluye seguridad básica (limitación de tamaño, integridad de ruta).
     * - Escalable para auditoría y control documental.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('filename', 255);
            $table->string('path');
            $table->morphs('documentable');
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

    }

    /**
     * Reversión segura de la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
