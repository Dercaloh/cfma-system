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

            // Datos básicos
            $table->string('name', 50)
                ->unique()
                ->comment('Nombre único del rol');
            $table->string('description', 255)
                ->nullable()
                ->comment('Descripción del rol');

            // Jerarquía numérica interna
            $table->unsignedTinyInteger('level')
                ->default(0)
                ->index()
                ->comment('Jerarquía numérica interna del sistema');

            // Auditoría estándar
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Usuario que creó el registro');
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Usuario que actualizó el registro por última vez');
            $table->foreignId('deleted_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Usuario que eliminó lógicamente el registro');

            $table->timestamps();
            $table->softDeletes();

            // Índices compuestos
            $table->index(['level', 'name'], 'idx_roles_level_name');
        });

        // Constraint para asegurarse de que level esté dentro de un rango válido
        DB::statement(<<<SQL
            ALTER TABLE roles
            ADD CONSTRAINT chk_roles_level
            CHECK (level BETWEEN 0 AND 10)
        SQL);
    }

    public function down(): void
    {
        // Primero eliminamos el constraint (MySQL necesita nombre explícito)
        DB::statement('ALTER TABLE roles DROP CHECK chk_roles_level');
        Schema::dropIfExists('roles');
    }
};
