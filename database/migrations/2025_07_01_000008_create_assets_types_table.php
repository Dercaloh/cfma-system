<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('asset_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()->comment('Nombre único del tipo de activo (ej. Portátil, Impresora)');
            $table->string('description', 255)->nullable()->comment('Descripción adicional del tipo');
            $table->boolean('active')->default(true)->index()->comment('Estado lógico del tipo de activo');


            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    public function down(): void {
        Schema::dropIfExists('asset_types');
    }
};
