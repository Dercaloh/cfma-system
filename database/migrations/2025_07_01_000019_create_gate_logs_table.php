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
                ->index()
                ->comment('Activo asociado al movimiento');

            $table->foreignId('user_id')
                ->nullable()
                ->index()
                ->comment('Usuario que hizo el movimiento');

            $table->enum('action', ['salida', 'entrada'])
                ->comment('Tipo de movimiento');

            $table->timestamp('logged_at')
                ->useCurrent()
                ->index()
                ->comment('Fecha y hora del registro');

            $table->text('notes')->nullable()->comment('Observaciones del movimiento');
            $table->fullText('notes');

            // Auditoría
            $table->foreignId('created_by')->nullable()->comment('Creado por');
            $table->foreignId('updated_by')->nullable()->comment('Actualizado por');
            $table->foreignId('deleted_by')->nullable()->comment('Eliminado por');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['asset_id', 'logged_at'], 'idx_gate_asset_fecha');

            // Claves foráneas explícitas (evita error 121)
            $table->foreign('asset_id', 'fk_gate_asset')->references('id')->on('assets')->cascadeOnDelete();
            $table->foreign('user_id', 'fk_gate_user')->references('id')->on('users')->nullOnDelete();

            $table->foreign('created_by', 'fk_gate_created_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by', 'fk_gate_updated_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('deleted_by', 'fk_gate_deleted_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gate_logs');
    }
};
