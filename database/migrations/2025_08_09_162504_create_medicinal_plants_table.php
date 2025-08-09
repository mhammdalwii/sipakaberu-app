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
        Schema::create('medicinal_plants', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama tanaman, cth: "Kunyit"
            $table->string('slug')->unique();
            $table->string('scientific_name')->nullable(); // Nama ilmiah, cth: "Curcuma longa"
            $table->string('image')->nullable(); // Gambar tanaman
            $table->text('description'); // Deskripsi umum tanaman
            $table->text('benefits')->nullable(); // Manfaat atau khasiat
            $table->text('how_to_use')->nullable(); // Cara penggunaan/pengolahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicinal_plants');
    }
};
