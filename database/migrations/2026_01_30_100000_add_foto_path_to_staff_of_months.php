<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('staff_of_months', function (Blueprint $table) {
            $table->string('foto_path')->nullable();
        });
    }

    public function down()
    {
        Schema::table('staff_of_months', function (Blueprint $table) {
            $table->dropColumn('foto_path');
        });
    }
};
