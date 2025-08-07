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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable(); // Untuk menyimpan path gambar
            $table->text('description')->nullable(); // Deskripsi singkat resep
            $table->text('ingredients'); // Bahan-bahan (bisa format list)
            $table->text('instructions'); // Langkah-langkah pembuatan
            $table->unsignedInteger('prep_time')->nullable(); // Waktu persiapan (menit)
            $table->unsignedInteger('cook_time')->nullable(); // Waktu memasak (menit)
            $table->string('servings')->nullable(); // Jumlah porsi (contoh: "4 orang")
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
