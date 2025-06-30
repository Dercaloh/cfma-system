<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loan_details', function (Blueprint $table) {
            $table->id();

            // Relación con préstamo
            $table->foreignId('loan_id')
                ->constrained()
                ->onDelete('cascade'); // Si se elimina el préstamo, se eliminan los detalles

            // Identificador de uso
            $table->enum('tipo_de_uso', ['formativo', 'administrativo']);

            // Campos específicos para uso formativo
            $table->string('ficha')->nullable();
            $table->string('programa')->nullable();
            $table->string('instructor')->nullable();

            // Campos específicos para uso administrativo
            $table->string('cargo')->nullable();
            $table->string('departamento')->nullable();

            // Campos comunes
            $table->string('sede');
            $table->time('hora_entrega');
            $table->unsignedTinyInteger('cantidad')->default(1);
            $table->string('proposito')->nullable();

            $table->timestamps(); // created_at / updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_details');
    }
};
