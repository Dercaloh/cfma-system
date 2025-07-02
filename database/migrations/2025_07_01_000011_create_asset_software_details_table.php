<?php
// 2025_06_22_000002_create_assets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_software_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();

            $table->string('name', 150);
            $table->string('version', 50)->nullable();
            $table->string('vendor', 100)->nullable();
            $table->enum('license_status', ['autorizado', 'no_autorizado', 'desactualizado'])->default('autorizado');
            $table->date('install_date')->nullable();

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['asset_id', 'license_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_software_details');
    }
};
