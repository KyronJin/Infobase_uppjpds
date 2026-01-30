<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description'); // Rename dari body
            $table->string('image_path')->nullable(); // Gambar
            $table->datetime('published_at')->nullable(); // Tanggal publikasi
            $table->datetime('unpublished_at')->nullable(); // Tanggal unpublikasi
            $table->datetime('valid_from')->nullable(); // Tanggal berlaku
            $table->datetime('valid_until')->nullable(); // Tanggal berakhir
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};