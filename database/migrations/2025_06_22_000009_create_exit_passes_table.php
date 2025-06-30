<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exit_passes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gate_log_id')->constrained()->onDelete('cascade');
            $table->string('cuentadante');
            $table->string('cedula');
            $table->string('dependencia');
            $table->enum('permiso', ['temporal', 'permanente', 'definitivo']);
            $table->timestamp('autorizado_salida')->nullable();
            $table->timestamp('autorizado_regreso')->nullable();

            // Firma responsable institucional
            $table->foreignId('signed_by')->nullable()->constrained('users')->nullOnDelete();

            // PDF institucional generado (se guarda con firma en actas)
            $table->string('archivo_pdf')->nullable();

            // Estado: pendiente, autorizado, denegado, vencido
            $table->enum('estado', ['pendiente', 'autorizado', 'rechazado', 'vencido'])->default('pendiente');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exit_passes');
    }
};
