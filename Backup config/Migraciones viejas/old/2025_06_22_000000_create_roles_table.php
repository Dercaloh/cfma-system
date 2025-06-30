<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Clave primaria (bigint auto_increment)
            $table->string('name', 50)->unique(); // Nombre corto único
            $table->string('description', 255)->nullable(); // Descripción opcional
            $table->timestamps(); // created_at / updated_at
            $table->softDeletes(); // deleted_at para auditoría
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
