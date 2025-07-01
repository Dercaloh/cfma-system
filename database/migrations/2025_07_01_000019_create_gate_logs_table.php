<?php
// 2025_06_22_000008_create_gate_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gate_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('asset_id')
                ->constrained()
                ->cascadeOnDelete()
                ->index();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->index();

            $table->enum('action', ['salida', 'entrada'])
                ->comment('Tipo de movimiento');

            $table->timestamp('logged_at')
                ->useCurrent()
                ->index()
                ->comment('Fecha y hora del registro');

            $table->text('notes')
                ->nullable()
                ->comment('Observaciones del movimiento');

            $table->fullText('notes');

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            // Índice para consultas frecuentes
            $table->index(['asset_id', 'logged_at'], 'idx_gate_asset_fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gate_logs');
    }
};
