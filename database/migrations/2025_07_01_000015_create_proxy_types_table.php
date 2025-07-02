<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proxy_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()->comment('Tipo de apoderado: Vocero, Subvocero, Monitor, etc.');

            $table->boolean('active')->default(true)->index()->comment('Habilitado para selección');

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proxy_types');
    }
};
