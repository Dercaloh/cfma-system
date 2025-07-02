<?php
// 2025_07_01_000003_add_user_fks_to_roles_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()
                ->after('level')->constrained('users')->nullOnDelete()
                ->comment('Usuario que creó el rol');

            $table->foreignId('updated_by')->nullable()
                ->after('created_by')->constrained('users')->nullOnDelete()
                ->comment('Última actualización');

            $table->foreignId('deleted_by')->nullable()
                ->after('updated_by')->constrained('users')->nullOnDelete()
                ->comment('Eliminación lógica');
        });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);

            $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
        });
    }
};
