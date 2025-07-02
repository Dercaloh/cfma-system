<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique()->comment('Identificador del permiso');
            $table->string('description', 255)->nullable()->comment('Descripción legible');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->comment('Creador del permiso');
            $table->timestamps();
            $table->softDeletes();
            $table->index('name', 'idx_permissions_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
