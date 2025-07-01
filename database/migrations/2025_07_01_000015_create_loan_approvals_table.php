<?php
// 2025_06_30_000005_create_loan_approvals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_approvals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('loan_id')
                ->constrained('loans')
                ->cascadeOnDelete()
                ->index()
                ->comment('Relación con el préstamo');

            $table->foreignId('decided_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->index()
                ->comment('Usuario que aprueba o rechaza la solicitud');

            $table->enum('status', ['pendiente', 'aprobado', 'rechazado'])
                ->default('pendiente')
                ->comment('Estado de la decisión');

            $table->text('justification')
                ->nullable()
                ->comment('Razón del rechazo o nota de aprobación');

            $table->timestamp('approved_at')
                ->nullable()
                ->index()
                ->comment('Fecha de decisión');

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            // Evita múltiples decisiones iguales por préstamo
            $table->unique(['loan_id', 'status'], 'unique_loan_status_decision');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_approvals');
    }
};
