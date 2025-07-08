<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     */
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

            // Relación con el usuario que genera el evento
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Acción ejecutada (login, update, delete, check-in, etc.)
            $table->string('action', 100); // límite razonable para búsquedas

            // Módulo afectado (ej. "activos", "préstamos", "usuarios", etc.)
            $table->string('module', 100);

            // Detalles adicionales de la acción (opcional, útil para debugging o trazabilidad)
            $table->text('details')->nullable();

            // IP desde donde se ejecutó la acción
            $table->ipAddress('ip_address')->nullable();

            // Información temporal
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};

