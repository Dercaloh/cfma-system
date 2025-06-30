<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla de préstamos.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            // Usuario que solicita el préstamo
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete(); // Mejora semántica

            // Activo solicitado
            $table->foreignId('asset_id')
                ->constrained()
                ->cascadeOnDelete();

            // Estado del préstamo (relación con loan_statuses)
            $table->foreignId('status_id')
                ->constrained('loan_statuses')
                ->restrictOnDelete(); // evita borrar estados con préstamos activos

            // Fechas de flujo de préstamo
            $table->timestamp('requested_at')->useCurrent(); // Registro automático
            $table->timestamp('approved_at')->nullable();    // Aprobado por supervisor/subdirector
            $table->timestamp('delivered_at')->nullable();   // Fecha de entrega física
            $table->timestamp('returned_at')->nullable();    // Fecha de devolución

            // Observaciones del proceso (auditoría simple)
            $table->text('notes')->nullable();

            // Auditoría y trazabilidad
            $table->timestamps();        // created_at y updated_at
            $table->softDeletes();       // deleted_at (no eliminación física)
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};

