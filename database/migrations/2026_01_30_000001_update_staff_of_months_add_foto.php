<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('staff_of_months', 'foto_path')) {
            Schema::table('staff_of_months', function (Blueprint $table) {
                $table->string('foto_path')->nullable()->after('bio');
            });
        }
    }

    public function down()
    {
        Schema::table('staff_of_months', function (Blueprint $table) {
            $table->dropColumn('foto_path');
        });
    }
};
