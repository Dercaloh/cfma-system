<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loan_approvals', function (Blueprint $table) {
            $table->id();

            // FK a loans
            $table->unsignedBigInteger('loan_id');
            $table->foreign('loan_id', 'fk_loan_approvals_loan_id')
                  ->references('id')->on('loans')->onDelete('cascade');
            $table->index('loan_id', 'idx_loan_approvals_loan_id');

            // FK a users
            $table->unsignedBigInteger('decided_by')->nullable();
            $table->foreign('decided_by', 'fk_loan_approvals_decided_by')
                  ->references('id')->on('users')->nullOnDelete();
            $table->index('decided_by', 'idx_loan_approvals_decided_by');

            $table->enum('status', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->text('justification')->nullable();
            $table->timestamp('approved_at')->nullable()->index();

            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by', 'fk_loan_approvals_created_by')
                  ->references('id')->on('users')->nullOnDelete();

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by', 'fk_loan_approvals_updated_by')
                  ->references('id')->on('users')->nullOnDelete();

            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by', 'fk_loan_approvals_deleted_by')
                  ->references('id')->on('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['loan_id', 'status'], 'unique_loan_status_decision');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_approvals');
    }
};
