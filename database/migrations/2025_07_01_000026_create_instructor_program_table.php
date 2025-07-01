<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instructor_program', function (Blueprint $table) {
            $table->id();

            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->enum('rol', ['técnico', 'promotor'])->default('promotor')->comment('Tipo de rol del instructor en el programa');

            $table->timestamps();
            $table->unique(['program_id', 'user_id', 'rol'], 'instructor_program_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instructor_program');
    }
};
