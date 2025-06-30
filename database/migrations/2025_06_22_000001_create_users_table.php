<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Usuarios
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('last_login_ip', 45)->nullable(); // Trazabilidad IP
            $table->string('password', 255);
            $table->string('employee_id', 20)->unique()->nullable()->index(); // Cédula interna

            $table->foreignId('role_id')->constrained('roles')->onDelete('restrict');
            $table->enum('status', ['activo', 'inactivo'])->default('activo'); // ISO9001 control acceso

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            // Auditoría ISO 27001
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
        });

        // Tokens para recuperación de contraseña
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->string('token', 64);
            $table->timestamp('created_at')->nullable();
        });

        // Control de sesiones del usuario
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('device', 100)->nullable(); // Ej: Chrome Win11, iPhone Safari
            $table->longText('payload');
            $table->integer('last_activity')->index(); // UNIX timestamp
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
