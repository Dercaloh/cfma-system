<?php
// 2025_06_22_000002_create_assets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            // Identificación básica
            $table->string('name', 100)->comment('Nombre del activo');
            $table->string('serial_number', 100)->comment('Número de serie');
            $table->string('placa', 50)->nullable()->comment('Número inventario institucional');
            $table->unique(['serial_number', 'placa'], 'unique_serial_placa');

            // Clasificación
            $table->foreignId('type_id')->constrained('asset_types')->comment('Tipo de activo');
            $table->enum('ownership', ['Centro', 'Personal'])->default('Centro')->index()->comment('Propiedad');

            // Datos generales (aplican a hardware y software)
            $table->string('brand', 50)->nullable();
            $table->string('model', 50)->nullable();
            $table->year('year_purchased')->nullable()->index()->comment('Año adquisición');

            // Estado y ubicación
            $table->enum('status', ['Disponible', 'Prestado', 'En mantenimiento', 'Retirado'])->default('Disponible')->index();
            $table->enum('condition', ['Bueno', 'Regular', 'Dañado', 'En diagnóstico'])->default('Bueno');
            $table->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete()->comment('Ubicación física');

            // Préstamo y movilidad
            $table->boolean('loanable')->default(true)->comment('¿Puede prestarse?');
            $table->boolean('movable')->default(false)->comment('¿Puede salir del recinto?');

            // Asignación
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete()->comment('Usuario asignado');

            // Descripción extendida (con índice FULLTEXT si es compatible)
            $table->text('description')->nullable();
            $table->fullText('description');

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
