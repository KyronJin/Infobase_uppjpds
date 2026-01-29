<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void
{
    Schema::create('profile_ruangans', function (Blueprint $table) {
        $table->id();
        $table->string('room_name');
        $table->string('floor')->nullable();
        $table->integer('capacity')->nullable();
        $table->text('description')->nullable();
        $table->string('photo_link')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('profile_ruangans');
    }
};
