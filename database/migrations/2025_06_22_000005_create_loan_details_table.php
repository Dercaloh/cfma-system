<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabla que almacena detalles contextuales del préstamo:
 * tipo de uso, contexto institucional, y autorización de terceros (apoderado).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_details', function (Blueprint $table) {
            $table->id();

            // Relación con el préstamo principal
            $table->foreignId('loan_id')->constrained()->onDelete('cascade');

            // Tipo de uso institucional
            $table->enum('tipo_de_uso', ['formativo', 'administrativo']);

            // Fecha deseada de entrega
            $table->date('fecha_entrega_deseada')->nullable();

            // === Formativo ===
            $table->string('ficha')->nullable();
            $table->string('programa')->nullable();
            $table->string('instructor')->nullable();

            // === Administrativo ===
            $table->string('cargo')->nullable();
            $table->string('departamento')->nullable();

            // === Apoderado (reclamación por tercero) ===
            $table->boolean('reclamado_por_apoderado')->default(false);
            $table->string('nombre_apoderado')->nullable();
            $table->enum('tipo_apoderado', [
                'Vocero', 'Subvocero', 'Funcionario', 'Monitor', 'Practicante'
            ])->nullable();
            $table->string('documento_apoderado', 20)->nullable();

            // === Comunes ===
            $table->string('sede');
            $table->time('hora_entrega');
            $table->unsignedTinyInteger('cantidad')->default(1);
            $table->string('proposito')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_details');
    }
};
