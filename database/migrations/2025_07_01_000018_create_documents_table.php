<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('Nombre original del documento');
            $table->string('mime_type', 100)->comment('Tipo MIME del archivo');
            $table->unsignedBigInteger('size')->comment('Tamaño del archivo en bytes');
            $table->string('hash_sha256', 64)->nullable()->comment('Hash SHA-256 para verificar integridad');

            $table->string('storage_path')->nullable()->comment('Ruta del archivo cifrado en Laravel Storage');

            // Relación polimórfica
            $table->unsignedBigInteger('documentable_id')->comment('ID del modelo asociado');
            $table->string('documentable_type')->comment('Clase del modelo asociado');

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->comment('Creado por');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete()->comment('Modificado por');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete()->comment('Eliminado por');

            $table->timestamps();
            $table->softDeletes();

            // Índices para búsqueda eficiente
            $table->index(['documentable_id', 'documentable_type'], 'idx_documentable');
            $table->index(['created_by', 'created_at'], 'idx_created_audit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
