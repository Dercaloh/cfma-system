<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('document_type', 10)
                ->after('id')
                ->default('CC') // Por defecto, cédula de ciudadanía
                ->comment('Tipo de documento: CC, TI, CE, NIT, PAS');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('document_type');
        });
    }
};
