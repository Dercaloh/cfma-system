<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            Schema::defaultStringLength(191); // Compatibilidad con índices utf8mb4

            $table->string('id', 128)->primary();

            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->cascadeOnDelete()
                  ->comment('Usuario autenticado, si aplica');

            $table->ipAddress('ip_address')
                  ->nullable()
                  ->comment('IP de origen de la sesión');

            $table->string('user_agent', 255)
                  ->nullable()
                  ->comment('Agente de navegador o dispositivo');

            $table->text('payload')
                  ->comment('Datos serializados y cifrados de la sesión');

            $table->unsignedInteger('last_activity')
                  ->index()
                  ->comment('Marca de tiempo UNIX de la última actividad');

            $table->timestamps();

            // Índices adicionales útiles para trazabilidad
            $table->index(['user_id', 'last_activity'], 'idx_user_activity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
