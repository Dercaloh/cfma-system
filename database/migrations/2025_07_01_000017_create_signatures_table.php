<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('signatures', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            Schema::defaultStringLength(191);

            $table->id();
            $table->foreignId('loan_id')->constrained('loans')->cascadeOnDelete()->comment('Préstamo asociado')->index();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->comment('Usuario que firma')->index();
            $table->enum('type', ['entrega', 'devolucion'])->comment('Tipo de firma: entrega o devolución');

            $table->binary('signature_blob')->comment('Firma en BLOB (ideal cifrado a nivel app)');
            $table->string('signature_hash', 64)->nullable()->comment('Hash SHA-256 para validar integridad del BLOB');
            $table->timestamp('signed_at')->useCurrent()->comment('Fecha/hora de la firma')->index();
            $table->text('observacion')->nullable()->comment('Comentarios u observaciones adicionales');

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->comment('Creado por');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete()->comment('Actualizado por');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete()->comment('Eliminado por');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['loan_id', 'user_id', 'type'], 'unique_signature_per_user_type');
            $table->index(['created_by', 'created_at'], 'idx_created_audit');
        });
    }

    public function down(): void {
        Schema::dropIfExists('signatures');
    }
};
