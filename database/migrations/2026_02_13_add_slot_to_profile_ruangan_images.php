<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('profile_ruangan_images', function (Blueprint $table) {
            $table->unsignedTinyInteger('slot')->default(1)->after('profile_ruangan_id');
        });
    }

    public function down(): void
    {
        Schema::table('profile_ruangan_images', function (Blueprint $table) {
            $table->dropColumn('slot');
        });
    }
};
