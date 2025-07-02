<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loan_request_data', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('loan_id');
            $table->foreign('loan_id', 'fk_loan_request_data_loan_id')
                  ->references('id')->on('loans')->onDelete('cascade');
            $table->index('loan_id', 'idx_loan_request_loan_id');

            $table->enum('tipo_de_uso', ['formativo', 'administrativo'])->index();
            $table->foreignId('program_id')->nullable()->constrained('programs')->nullOnDelete();
            $table->foreignId('instructor_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('proposito', 255)->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();

            $table->date('fecha_entrega_deseada')->nullable()->index();
            $table->boolean('reclamado_por_apoderado')->default(false);
            $table->string('nombre_apoderado', 100)->nullable();
            $table->string('documento_apoderado', 20)->nullable();
            $table->foreignId('proxy_type_id')->nullable()->constrained('proxy_types')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_request_data');
    }
};
