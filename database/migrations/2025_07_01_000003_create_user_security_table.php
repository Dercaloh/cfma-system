<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_security', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->unique();

            $table->binary('mfa_secret')->nullable()->comment('Secreto TOTP encriptado');
            $table->boolean('mfa_enabled')->default(false)->comment('MFA activado');

            $table->timestamp('mfa_enabled_at')->nullable()->comment('Fecha de activación');
            $table->ipAddress('mfa_last_ip')->nullable()->comment('Última IP de validación MFA');
            $table->timestamp('mfa_last_verified_at')->nullable()->comment('Último acceso exitoso con MFA');

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_security');
    }
};
