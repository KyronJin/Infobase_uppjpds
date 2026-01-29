<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
       // database/migrations/..._create_pengumumans_table.php
Schema::create('pengumumans', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('body');
    $table->dateTime('published_at')->nullable();
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('pengumumans');
    }
};
