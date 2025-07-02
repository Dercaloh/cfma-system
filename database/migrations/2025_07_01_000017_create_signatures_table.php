<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('signatures', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            Schema::defaultStringLength(191);

            $table->id();

            $table->unsignedBigInteger('loan_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['entrega', 'devolucion'])->comment('Tipo de firma');

            $table->binary('signature_blob')->comment('Firma en BLOB');
            $table->string('signature_hash', 64)->nullable()->comment('Hash SHA-256');
            $table->timestamp('signed_at')->useCurrent()->comment('Fecha firma')->index();
            $table->text('observacion')->nullable();

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['loan_id', 'user_id', 'type'], 'unique_signature_per_user_type');
            $table->index(['created_by', 'created_at'], 'idx_created_audit');

            // Foreign keys nombradas para evitar conflictos
            $table->foreign('loan_id', 'fk_signatures_loan_id')->references('id')->on('loans')->cascadeOnDelete();
            $table->foreign('user_id', 'fk_signatures_user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
