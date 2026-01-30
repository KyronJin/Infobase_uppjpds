<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profile_ruangan_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_ruangan_id')->constrained('profile_ruangans')->onDelete('cascade');
            $table->string('image_path'); // Path ke file gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_ruangan_images');
    }
};