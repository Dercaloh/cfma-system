<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabla de activos tecnológicos del CFMA.
 * Incluye trazabilidad, asignación, estado técnico, movilidad y clasificación.
 * Cumple con estándares de seguridad, usabilidad y auditoría institucional.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            // Identificación institucional y técnica
            $table->string('name');                         // Nombre común del activo
            $table->string('serial_number')->unique();      // Serial del fabricante
            $table->string('placa')->nullable()->unique();  // Código institucional del centro (placa SENA)

            // Clasificación y propiedad
            $table->enum('type', [
                'Portátil', 'Proyector', 'Router', 'Switch', 'Impresora', 'Tablet', 'Teléfono', 'Otro'
            ]);
            $table->enum('ownership', ['Centro', 'Personal'])->default('Centro'); // Propiedad institucional o personal

            // Especificaciones técnicas
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('os')->nullable();               // Sistema operativo (si aplica)
            $table->year('year_purchased')->nullable();     // Año de adquisición

            // Estados y ubicación
            $table->enum('status', ['Disponible', 'Prestado', 'En mantenimiento', 'Retirado'])->default('Disponible');
            $table->enum('condition', ['Bueno', 'Regular', 'Dañado', 'En diagnóstico'])->default('Bueno');
            $table->enum('location', ['Almacén', 'Con usuario', 'En préstamo', 'Otro'])->default('Almacén');

            // Control de préstamos y movilidad
            $table->boolean('loanable')->default(true);     // ¿Puede prestarse?
            $table->boolean('movable')->default(false);     // ¿Puede salir del CFMA?

            // Asignación de cuentadante (usuario responsable)
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();

            // Descripción general y observaciones
            $table->text('description')->nullable();
            $table->string('mac_address')->nullable()->unique(); // Para dispositivos de red

            // Auditoría
            $table->timestamps();      // created_at y updated_at
            $table->softDeletes();     // deleted_at (para trazabilidad sin pérdida de datos)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
