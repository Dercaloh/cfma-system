<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla de activos de TI.
     *
     * Esta tabla almacena todos los equipos del inventario tecnológico (portátiles, routers, proyectores, etc.)
     * Incluye campos clave para la trazabilidad, mantenimiento y vinculación futura a préstamos y documentación.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del equipo
            // Identificador único por activo
            $table->string('serial_number')->unique();


            // Clasificación básica del equipo
            $table->enum('type', [
                'Portátil', 'Proyector', 'Router', 'Switch', 'Impresora', 'Otro'
            ]);

            // Información técnica
            $table->string('brand')->nullable();
            $table->string('model')->nullable();

            // Estado lógico del activo
            $table->enum('status', [
                'Disponible', 'Prestado', 'En mantenimiento', 'Retirado'
            ])->default('Disponible');

            $table->text('description')->nullable();
            // Nuevo campo: usuario responsable del activo (cuentadante)
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            // Auditoría
            $table->timestamps();        // created_at y updated_at
            $table->softDeletes();       // deleted_at (para no borrar físicamente)
        });
    }

    /**
     * Reversión de la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
