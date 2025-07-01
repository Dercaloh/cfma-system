<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();

            // Datos de permiso
            $table->string('name', 100)
                  ->unique()
                  ->comment('Identificador único del permiso (ej: manage_users)');
            $table->string('description', 255)
                  ->nullable()
                  ->comment('Descripción legible del permiso');

            // Auditoría mínima
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete()
                  ->comment('Usuario que creó el permiso');
            $table->timestamps();
            $table->softDeletes();

            // Índice para búsquedas rápidas
            $table->index('name', 'idx_permissions_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
