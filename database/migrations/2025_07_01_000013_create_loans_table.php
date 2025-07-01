<?php
// 2025_06_22_000004_create_loans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete()
                  ->comment('Usuario solicitante');
            $table->foreignId('asset_id')
                  ->constrained()
                  ->cascadeOnDelete()
                  ->comment('Activo prestado');
            $table->foreignId('status_id')
                  ->constrained('loan_statuses')
                  ->restrictOnDelete()
                  ->index()
                  ->comment('Estado actual del préstamo');

            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('delivered_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('received_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamp('requested_at')->useCurrent()->index()->comment('Fecha de solicitud');
            $table->timestamp('approved_at')->nullable()->index()->comment('Fecha de aprobación');
            $table->timestamp('delivered_at')->nullable()->comment('Fecha de entrega');
            $table->timestamp('returned_at')->nullable()->index()->comment('Fecha de devolución');

            $table->text('notes')->nullable()->comment('Observaciones generales');

            // Índice compuesto para consultar préstamos por usuario y fecha
            $table->index(['user_id', 'requested_at'], 'loans_user_requested_idx');

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            // Si se prevén muchos registros, considerar particionado por año:
            // DB::statement("ALTER TABLE loans PARTITION BY RANGE (YEAR(requested_at)) (...)");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
