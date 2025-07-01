<?php
// 2025_06_22_000002_create_assets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_hardware_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->unique()->constrained('assets')->cascadeOnDelete();

            $table->string('mac_address', 17)->nullable()->unique()->comment('MAC física, formato XX:XX:XX:XX:XX:XX');
            $table->string('os', 50)->nullable()->comment('Sistema operativo');
            $table->string('bios_version', 50)->nullable()->comment('Versión BIOS/UEFI');
            $table->string('cpu', 100)->nullable();
            $table->string('ram', 50)->nullable();
            $table->string('storage', 100)->nullable();

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
