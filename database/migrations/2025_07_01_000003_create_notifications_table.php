<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla de notificaciones internas del sistema SGPTI
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->comment('Usuario que recibirá la notificación');

            $table->string('type', 50)
                ->comment('Tipo de evento notificado: préstamo, alerta, sistema, etc.');

            $table->string('title', 100)
                ->comment('Título breve o resumen visible de la notificación');

            $table->text('message')
                ->comment('Contenido completo de la notificación');

            $table->boolean('is_read')
                ->default(false)
                ->comment('Marca si el usuario ya la leyó');

            $table->timestamp('read_at')
                ->nullable()
                ->comment('Fecha y hora exacta en la que fue leída');

            $table->timestamps();

            // Índices para acelerar consultas por usuario y no leídas
            $table->index(['user_id', 'is_read'], 'idx_user_read_status');
        });
    }

    /**
     * Reversión de la tabla
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
