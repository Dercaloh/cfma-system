<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loan_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('loan_id');
            $table->foreign('loan_id', 'fk_loan_details_loan_id')
                  ->references('id')->on('loans')
                  ->onDelete('cascade');
            $table->index('loan_id', 'idx_loan_details_loan_id');

            $table->unsignedTinyInteger('cantidad')->default(1)->comment('Cantidad de activos prestados');
            $table->unsignedTinyInteger('dias_solicitados')->default(1)->comment('Días solicitados para el préstamo');
            $table->enum('modalidad_entrega', ['presencial', 'delegado'])->default('presencial');
            $table->time('hora_entrega')->comment('Hora pactada de entrega');

            $table->timestamps(); // No se usa softDeletes por lógica del ciclo de vida
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_details');
    }
};
