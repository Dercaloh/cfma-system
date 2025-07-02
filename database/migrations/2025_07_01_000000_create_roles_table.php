<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()->comment('Nombre único del rol');
            $table->string('description', 255)->nullable()->comment('Descripción del rol');
            $table->unsignedTinyInteger('level')->default(0)->index()->comment('Jerarquía interna');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['level', 'name'], 'idx_roles_level_name');
        });

        // Constraint CHECK separada (por compatibilidad con algunos motores)
        DB::statement("ALTER TABLE roles ADD CONSTRAINT chk_roles_level CHECK (level BETWEEN 0 AND 10)");
    }

    public function down(): void
    {
        // Primero eliminamos el constraint (MySQL necesita nombre explícito)
        DB::statement('ALTER TABLE roles DROP CHECK chk_roles_level');
        Schema::dropIfExists('roles');
    }
};
