<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            // Identificador único del centro (si es institucional)
            $table->string('placa')->nullable()->unique()->after('serial_number');

            // Propiedad del activo
            $table->enum('ownership', ['Centro', 'Personal'])->default('Centro')->after('placa');

            // Asignación actual
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete()->after('ownership');

            // Permite préstamo sí/no
            $table->boolean('loanable')->default(true)->after('assigned_to');

            // Permite salida del centro sí/no
            $table->boolean('movable')->default(false)->after('loanable');

            // Estado técnico (por mantenimiento)
            $table->enum('condition', ['Bueno', 'Regular', 'Dañado', 'En diagnóstico'])->default('Bueno')->after('status');

            // Ubicación lógica
            $table->enum('location', ['Almacén', 'Con usuario'])->default('Almacén')->after('condition');
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn([
                'placa', 'ownership', 'assigned_to',
                'loanable', 'movable', 'condition', 'location'
            ]);
        });
    }
};
