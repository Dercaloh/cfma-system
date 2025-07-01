<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('loan_details');

        Schema::create('loan_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('loan_id')
                ->constrained('loans')
                ->cascadeOnDelete()
                ->index()
                ->comment('Referencia al préstamo');

            $table->unsignedTinyInteger('cantidad')->default(1)->comment('Cantidad de activos prestados');
            $table->unsignedTinyInteger('dias_solicitados')->default(1)->comment('Días solicitados para el préstamo');
            $table->enum('modalidad_entrega', ['presencial', 'delegado'])->default('presencial')->comment('Modalidad en la que se entrega el activo');
            $table->time('hora_entrega')->comment('Hora pactada de entrega');

            $table->timestamps(); // No se usa softDeletes por lógica del ciclo de vida del préstamo
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_details');
    }
};
