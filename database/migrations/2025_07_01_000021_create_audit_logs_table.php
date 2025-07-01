<?php
// 2025_06_22_000010_create_audit_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->index()
                ->comment('Usuario que ejecutó la acción');

            $table->string('action', 100)
                ->comment('Acción ejecutada (ej: create_loan, update_asset)');

            $table->string('module', 100)
                ->comment('Módulo afectado (loans, assets, users, etc)');

            $table->text('details')
                ->nullable()
                ->comment('Descripción contextual o JSON de cambios');

            $table->ipAddress('ip_address')
                ->nullable()
                ->comment('IP de origen del evento');

            $table->string('user_agent', 255)
                ->nullable()
                ->comment('Agente del navegador o cliente que originó la acción');

            // Auditoría administrativa
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();      // created_at, updated_at
            $table->softDeletes();     // deleted_at lógico

            // Índices clave
            $table->index('created_at');
            $table->index(['user_id', 'created_at'], 'idx_user_fecha_audit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
