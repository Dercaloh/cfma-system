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

            // Nombre original del archivo (validar en controladores)
            $table->string('filename', 255);

            // Ruta relativa segura en el Storage (no pública directamente)
            $table->string('path');

            // Relación polimórfica con modelos como Asset o Loan
            $table->morphs('documentable');

            // (Opcional) Tipo de documento: PDF, imagen, contrato, etc.
            $table->string('type')->nullable();

            // (Opcional) Descripción del archivo o su propósito
            $table->text('description')->nullable();

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
