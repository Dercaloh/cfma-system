<?php
// 2025_06_22_000009_create_exit_passes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exit_passes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('gate_log_id')
                ->index()
                ->comment('Registro de entrada/salida relacionado');

            $table->string('cuentadante', 100)->comment('Responsable de salida');
            $table->string('cedula', 20)->comment('Documento del cuentadante');
            $table->string('dependencia', 100)->comment('Área solicitante');

            $table->enum('permiso', ['temporal', 'permanente', 'definitivo'])
                ->index()
                ->comment('Tipo de salida autorizada');

            $table->timestamp('autorizado_salida')->nullable()->comment('Autorización de salida');
            $table->timestamp('autorizado_regreso')->nullable()->comment('Autorización de reingreso');

            $table->foreignId('signed_by')
                ->nullable()
                ->index()
                ->comment('Usuario que firmó la salida');

            $table->string('archivo_pdf')->nullable()->comment('Ruta del archivo PDF firmado');

            $table->enum('estado', ['pendiente', 'autorizado', 'rechazado', 'vencido'])
                ->default('pendiente')
                ->index()
                ->comment('Estado actual del pase');

            // Auditoría
            $table->foreignId('created_by')->nullable()->comment('Creado por');
            $table->foreignId('updated_by')->nullable()->comment('Actualizado por');
            $table->foreignId('deleted_by')->nullable()->comment('Eliminado por');

            $table->timestamps();
            $table->softDeletes();

            // Claves foráneas explícitas (evita error 121)
            $table->foreign('gate_log_id', 'fk_exit_gate_log')->references('id')->on('gate_logs')->cascadeOnDelete();
            $table->foreign('signed_by', 'fk_exit_signed_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('created_by', 'fk_exit_created_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by', 'fk_exit_updated_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('deleted_by', 'fk_exit_deleted_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exit_passes');
    }
};
