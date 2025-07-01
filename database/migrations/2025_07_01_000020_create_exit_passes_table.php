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
                ->constrained('gate_logs')
                ->cascadeOnDelete()
                ->index();

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
                ->constrained('users')
                ->nullOnDelete()
                ->index()
                ->comment('Usuario que firmó la salida');

            $table->string('archivo_pdf')->nullable()->comment('Ruta del archivo PDF firmado');

            $table->enum('estado', ['pendiente', 'autorizado', 'rechazado', 'vencido'])
                ->default('pendiente')
                ->index()
                ->comment('Estado actual del pase');

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exit_passes');
    }
};
