<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('pengumumans', 'status')) {
            Schema::table('pengumumans', function (Blueprint $table) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('valid_until');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pengumumans', 'status')) {
            Schema::table('pengumumans', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
