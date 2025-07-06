<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     */
    public function up(): void
    {
        Schema::create('policy_views', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->ipAddress('ip_address');
            $table->text('user_agent')->nullable();
            $table->timestamp('viewed_at')->useCurrent();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('policy_version', 10)->default('1.0.0');

            // Índices y relaciones
            $table->index('viewed_at');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_views');
    }
};
