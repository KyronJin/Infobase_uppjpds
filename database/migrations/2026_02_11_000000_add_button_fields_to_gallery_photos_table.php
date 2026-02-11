<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->string('button_text')->nullable()->after('order');
            $table->string('button_link')->nullable()->after('button_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->dropColumn(['button_text', 'button_link']);
        });
    }
};