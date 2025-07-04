<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->foreignId('role_id')
                  ->constrained('roles')
                  ->cascadeOnDelete();
            $table->foreignId('permission_id')
                  ->constrained('permissions')
                  ->cascadeOnDelete();

            // Auditar quién asignó el permiso (opcional)
            $table->foreignId('assigned_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete()
                  ->comment('Usuario que asignó este permiso al rol');

            $table->timestamps();

            // Clave primaria compuesta evita duplicados
            $table->primary(['role_id', 'permission_id'], 'pk_role_permission');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
