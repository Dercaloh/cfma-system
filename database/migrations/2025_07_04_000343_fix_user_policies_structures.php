<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_policies', function (Blueprint $table) {
            if (!Schema::hasColumn('user_policies', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('user_policies', 'policy_name')) {
                $table->string('policy_name')->after('user_id');
            }

            if (!Schema::hasColumn('user_policies', 'policy_version')) {
                $table->string('policy_version')->default('1.0')->after('policy_name');
            }

            if (!Schema::hasColumn('user_policies', 'accepted_at')) {
                $table->timestamp('accepted_at')->after('policy_version');
            }

            if (!Schema::hasColumn('user_policies', 'accepted_ip')) {
                $table->ipAddress('accepted_ip')->nullable()->after('accepted_at');
            }

            if (!Schema::hasColumn('user_policies', 'accepted_user_agent')) {
                $table->text('accepted_user_agent')->nullable()->after('accepted_ip');
            }

            if (!Schema::hasColumn('user_policies', 'created_at')) {
                $table->timestamps(); // created_at y updated_at
            }
        });
    }

    public function down(): void
    {
        Schema::table('user_policies', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'policy_name',
                'policy_version',
                'accepted_at',
                'accepted_ip',
                'accepted_user_agent',
                'created_at',
                'updated_at'
            ]);
        });
    }
};
