<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Agrega campos de auditoría a tablas críticas del sistema
     */
    public function up(): void
    {
        $tables = [
            'users', 'assets', 'loans', 'loan_details',
            'signatures', 'documents', 'gate_logs', 'exit_passes'
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (!Schema::hasColumn($tableName, 'created_by')) {
                        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->after('id');
                    }
                    if (!Schema::hasColumn($tableName, 'updated_by')) {
                        $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete()->after('created_by');
                    }
                    if (!Schema::hasColumn($tableName, 'deleted_by')) {
                        $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete()->after('updated_by');
                    }
                    if (!Schema::hasColumn($tableName, 'deleted_at')) {
                        $table->softDeletes();
                    }
                });
            }
        }
    }

    /**
     * Reversión segura
     */
    public function down(): void
    {
        $tables = [
            'users', 'assets', 'loans', 'loan_details',
            'signatures', 'documents', 'gate_logs', 'exit_passes'
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropSoftDeletes();
                    $table->dropForeign(['created_by']);
                    $table->dropForeign(['updated_by']);
                    $table->dropForeign(['deleted_by']);
                    $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
                });
            }
        }
    }
};
