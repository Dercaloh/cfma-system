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
                ->index()
                ->comment('Usuario que ejecutó la acción');

            $table->string('action', 100)->comment('Acción ejecutada (ej: create_loan, update_asset)');
            $table->string('module', 100)->comment('Módulo afectado');
            $table->text('details')->nullable()->comment('Detalles JSON o descripción de la acción');

            $table->ipAddress('ip_address')->nullable()->comment('IP del evento');
            $table->string('user_agent', 255)->nullable()->comment('Navegador / agente de usuario');

            $table->foreignId('created_by')->nullable()->comment('Creado por');
            $table->foreignId('updated_by')->nullable()->comment('Actualizado por');
            $table->foreignId('deleted_by')->nullable()->comment('Eliminado por');

            $table->timestamps();
            $table->softDeletes();

            $table->index('created_at');
            $table->index(['user_id', 'created_at'], 'idx_user_fecha_audit');

            // Foreign keys nombradas
            $table->foreign('user_id', 'fk_audit_user')->references('id')->on('users')->nullOnDelete();
            $table->foreign('created_by', 'fk_audit_created_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by', 'fk_audit_updated_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('deleted_by', 'fk_audit_deleted_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
