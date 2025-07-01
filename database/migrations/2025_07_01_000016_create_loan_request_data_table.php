<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_request_data', function (Blueprint $table) {
            $table->id();

            $table->foreignId('loan_id')
                ->constrained('loans')
                ->cascadeOnDelete()
                ->index()
                ->comment('Referencia al préstamo');

            $table->enum('tipo_de_uso', ['formativo', 'administrativo'])->index()->comment('Finalidad del préstamo');
            $table->foreignId('program_id')->nullable()->constrained('programs')->nullOnDelete()->comment('Programa asociado si aplica');
            $table->foreignId('instructor_id')->nullable()->constrained('users')->nullOnDelete()->comment('Instructor responsable de la ficha, si aplica');

            $table->string('proposito', 255)->nullable()->comment('Propósito del préstamo en contexto administrativo');

            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete()->comment('Departamento solicitante');
            $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete()->comment('Cargo del solicitante');

            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete()->comment('Lugar de entrega del activo');
            $table->date('fecha_entrega_deseada')->nullable()->index()->comment('Fecha tentativa para la entrega del activo');

            $table->boolean('reclamado_por_apoderado')->default(false)->comment('¿Reclamado por apoderado?');
            $table->string('nombre_apoderado', 100)->nullable();
            $table->string('documento_apoderado', 20)->nullable();
            $table->foreignId('proxy_type_id')->nullable()->constrained('proxy_types')->nullOnDelete()->comment('Tipo de apoderado si aplica');

            $table->timestamps(); // No se usa softDeletes porque esta tabla depende de loans
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_request_data');
    }
};
