<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('description')->nullable()->after('name');
            $table->unsignedTinyInteger('level')->default(9)->after('description'); // Nivel por defecto: Aprendiz
        });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn(['description', 'level']);
        });
    }
};
