<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up(): void
    {
        // Evitar errores si la tabla ya existe
        if (! Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                // Clave primaria de 128 caracteres (longitud por defecto de Laravel)
                $table->string('id', 128)->primary();

                // Relación opcional con usuarios para trazabilidad
                $table->foreignId('user_id')
                      ->nullable()
                      ->constrained('users')
                      ->onDelete('cascade')
                      ->comment('Usuario propietario de la sesión');

                // Auditoría básica
                $table->string('ip_address', 45)
                      ->nullable()
                      ->comment('IP del cliente');
                $table->text('user_agent')
                      ->nullable()
                      ->comment('User-Agent del cliente');

                // Payload cifrado de la sesión
                $table->text('payload')
                      ->comment('Datos serializados y cifrados de la sesión');

                // Última actividad, indexada para consultas rápidas
                $table->unsignedInteger('last_activity')
                      ->index()
                      ->comment('Timestamp de la última actividad');

                // Timestamps para auditoría adicional
                $table->timestamps();

                // Garantizar uso de InnoDB (transacciones, integridad referencial)
                $table->engine = 'InnoDB';
            });
        }
    }

    /**
     * Revierte las migraciones.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
