<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('loan_details', function (Blueprint $table) {
            $table->date('fecha_entrega_deseada')->nullable()->after('tipo_de_uso');
        });
    }

    public function down(): void
    {
        Schema::table('loan_details', function (Blueprint $table) {
            $table->dropColumn('fecha_entrega_deseada');
        });
    }
};
