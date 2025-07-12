<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 👋 Eliminar campo obsoleto
            if (Schema::hasColumn('users', 'employee_id')) {
                $table->dropColumn('employee_id');
            }

            // 🧹 Eliminar job_title si se migra a position_id
            if (Schema::hasColumn('users', 'job_title')) {
                $table->dropColumn('job_title');
            }

            // ➕ Agregar position_id como clave foránea
            $table->foreignId('position_id')
                ->nullable()
                ->constrained('positions')
                ->nullOnDelete()
                ->after('department_id');

            // ➕ Correos alternos
            $table->string('institutional_email', 100)->nullable()->after('email');
            $table->string('personal_email', 100)->nullable()->after('institutional_email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 🔙 Restaurar columnas eliminadas
            $table->string('employee_id', 20)->nullable()->after('last_login_ip');
            $table->string('job_title', 100)->nullable()->after('employee_id');

            // 🔙 Eliminar columnas agregadas
            $table->dropForeign(['position_id']);
            $table->dropColumn(['position_id', 'institutional_email', 'personal_email']);
        });
    }
};
