<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Datos personales
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('full_name', 101)
                  ->virtualAs("CONCAT(first_name, ' ', last_name)")
                  ->stored();

            // Autenticación
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('Hash bcrypt o argon2');

            // Campos para MFA mínimo si se requiere mantener legacy (recomendado mover a user_security)
            $table->binary('mfa_secret')->nullable()->comment('AES-256 en DB (legacy, usar user_security)');
            $table->binary('phone_for_otp')->nullable()->comment('AES-256 en DB (legacy, usar user_security)');
            $table->boolean('mfa_enabled')->default(false);

            // Control de contraseñas
            $table->timestamp('last_password_change_at')->nullable();
            $table->string('password_policy_version', 10)->nullable();

            // Sesiones y auditoría de acceso
            $table->timestamp('last_login_at')->nullable()->index();
            $table->ipAddress('last_login_ip')->nullable();
            $table->binary('device_info_encrypted')->nullable()->comment('AES-256 en DB');

            // Organización y estructura
            $table->string('employee_id', 20)->nullable()->unique();
            $table->string('job_title', 100)->nullable();
            $table->foreignId('department_id')->nullable()
                  ->constrained('departments')
                  ->nullOnDelete();
            $table->foreignId('location_id')->nullable()
                  ->constrained('locations')
                  ->nullOnDelete()
                  ->comment('FK ubicación');

            // Estado de cuenta
            $table->enum('status', ['activo', 'inactivo', 'suspendido', 'eliminado'])
                  ->default('activo')
                  ->index();
            $table->foreignId('role_id')
                  ->constrained('roles')
                  ->restrictOnDelete();
            $table->date('account_valid_from')->nullable();
            $table->date('account_valid_until')->nullable();

            // Consentimientos GDPR / privacidad
            $table->boolean('consent_data_processing')->default(false);
            $table->boolean('consent_marketing')->default(false);
            $table->boolean('consent_data_sharing')->default(false);
            $table->timestamp('consent_timestamp')->nullable();
            $table->string('privacy_policy_version', 10)->nullable();

            // Tokens para "remember me"
            $table->rememberToken();

            // Auditoría ISO 27001
            $table->foreignId('created_by')->nullable()
                  ->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()
                  ->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()
                  ->constrained('users')->nullOnDelete();

            // Timestamps y borrado lógico
            $table->timestamps();
            $table->softDeletes();

            // Índices adicionales para optimización
            $table->index(['email_verified_at', 'status'], 'idx_email_status');
            $table->index(['created_by', 'created_at'], 'idx_user_audit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
