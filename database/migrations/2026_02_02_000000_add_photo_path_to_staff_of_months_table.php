<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasColumn('staff_of_months', 'photo_path')) {
            Schema::table('staff_of_months', function (Blueprint $table) {
                $table->string('photo_path')->nullable()->after('bio');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('staff_of_months', 'photo_path')) {
            Schema::table('staff_of_months', function (Blueprint $table) {
                $table->dropColumn('photo_path');
            });
        }
    }
};
