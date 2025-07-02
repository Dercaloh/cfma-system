<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Información personal
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('full_name', 101)->virtualAs("CONCAT(first_name, ' ', last_name)")->stored();

            // Autenticación
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // Seguridad avanzada
            $table->binary('mfa_secret')->nullable();
            $table->binary('phone_for_otp')->nullable();
            $table->boolean('mfa_enabled')->default(false);
            $table->timestamp('last_password_change_at')->nullable();
            $table->string('password_policy_version', 10)->nullable();
            $table->timestamp('last_login_at')->nullable()->index();
            $table->ipAddress('last_login_ip')->nullable();
            $table->binary('device_info_encrypted')->nullable();

            // Identidad organizacional
            $table->string('employee_id', 20)->nullable()->unique();
            $table->string('job_title', 100)->nullable();

            // 🔁 Relaciones (se agregan después con FK explícitas)
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable(); // Se protegerá luego con FK

            // Estado de cuenta
            $table->enum('status', ['activo', 'inactivo', 'suspendido', 'eliminado'])->default('activo')->index();
            $table->date('account_valid_from')->nullable();
            $table->date('account_valid_until')->nullable();

            // Consentimientos legales
            $table->boolean('consent_data_processing')->default(false);
            $table->boolean('consent_marketing')->default(false);
            $table->boolean('consent_data_sharing')->default(false);
            $table->timestamp('consent_timestamp')->nullable();
            $table->string('privacy_policy_version', 10)->nullable();

            // Auditoría de actividad
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            // Índices adicionales
            $table->index(['email_verified_at', 'status'], 'idx_email_status');
            $table->index(['created_by', 'created_at'], 'idx_user_audit');
        });

        // ✅ Crear usuario root directamente durante la migración
        DB::table('users')->insert([
            'first_name' => 'Root',
            'last_name' => 'Administrator',
            'username' => 'root',
            'email' => 'root@cfma.edu.co',
            'password' => Hash::make('Cambiar123*'), // Obligatorio cambiar luego
            'status' => 'activo',
            'role_id' => null, // Se asignará luego
            'department_id' => null,
            'location_id' => null,
            'consent_data_processing' => true,
            'consent_timestamp' => now(),
            'privacy_policy_version' => '1.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
