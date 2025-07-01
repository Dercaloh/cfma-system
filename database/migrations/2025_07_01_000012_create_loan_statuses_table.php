<?php
// 2025_06_22_000003_create_loan_statuses_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()->comment('Estado único del préstamo');
            $table->string('description', 255)->nullable()->comment('Descripción del estado');
            // Campo de orden para UI
            $table->unsignedTinyInteger('order_index')->default(0)->index()->comment('Posición en listados');

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
        Schema::dropIfExists('loan_statuses');
    }
};
