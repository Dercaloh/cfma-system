<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalAssetTables extends Migration
{
    public function up(): void
    {
        // 🟡 Control de entradas y salidas
        Schema::create('entry_exit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // 🔴 Vinculado a usuario
            $table->timestamp('entry_time')->nullable(); // 🟡 Fecha y hora entrada
            $table->timestamp('exit_time')->nullable();  // 🟡 Fecha y hora salida
            $table->string('access_point')->nullable();  // 🟡 Punto de acceso físico
            $table->string('observations')->nullable();  // 🟡 Comentarios o anomalías
            $table->ipAddress('ip_address')->nullable(); // 🟡 IP de acceso
            $table->string('user_agent')->nullable();    // 🟡 Navegador/dispositivo
            $table->timestamps();
        });

        // 🟢 🟡 🔴 Bienes inmuebles (propios o en comodato)
        Schema::create('real_estate_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 🟢 Nombre del inmueble
            $table->enum('ownership_type', ['Propiedad', 'Comodato', 'Arriendo', 'Otro']); // 🟡
            $table->string('address');         // 🟡 Dirección completa
            $table->string('municipality');    // 🟢 Municipio
            $table->decimal('area_m2', 10, 2)->nullable(); // 🟡 Área en m2
            $table->enum('use_type', ['Formación', 'Administrativo', 'Mixto', 'Otro']); // 🟡 Uso institucional
            $table->string('legal_document')->nullable(); // 🔴 Escritura o convenio
            $table->text('description')->nullable();      // 🟢 Observaciones
            $table->boolean('active')->default(true);     // 🟡 Activo lógico
            $table->timestamps();
        });

        // 🟢 🟡 🔴 Activos intangibles
        Schema::create('intangible_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 🟢 Nombre (ej. "Office 365", "Marca X")
            $table->enum('origin', ['Propio', 'Adquirido']); // 🟡
            $table->string('type'); // 🟢 Tipo (ej. software, patente)
            $table->string('license_number')->nullable(); // 🟡 Número de licencia
            $table->date('acquisition_date')->nullable(); // 🟡
            $table->date('expiration_date')->nullable();  // 🟡
            $table->decimal('acquisition_cost', 12, 2)->nullable(); // 🟡 Valor de adquisición
            $table->text('description')->nullable();      // 🟢
            $table->string('support_document')->nullable(); // 🔴 Archivo legal soporte (PDF, etc.)
            $table->boolean('active')->default(true);     // 🟡 Estado lógico
            $table->timestamps();
        });

        // 🟡 🔴 Registro de bajas de bienes muebles
        Schema::create('asset_disposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade'); // 🔴 Relación con activo
            $table->date('disposal_date'); // 🟡 Fecha de baja
            $table->enum('reason', ['Obsolescencia', 'Daño', 'Pérdida', 'Donación', 'Otro']); // 🟡 Motivo
            $table->string('support_document')->nullable(); // 🔴 Documento soporte baja
            $table->text('observations')->nullable();       // 🟡 Detalles adicionales
            $table->foreignId('processed_by')->nullable()->constrained('users'); // 🔴 Responsable
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_disposals');
        Schema::dropIfExists('intangible_assets');
        Schema::dropIfExists('real_estate_assets');
        Schema::dropIfExists('entry_exit_logs');
    }
}
