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
        Schema::create('posyandus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Posyandu, cth: "Posyandu Melati 1"
            $table->text('address'); // Alamat lengkap Posyandu
            $table->string('village'); // Kelurahan/Desa
            $table->string('sub_district'); // Kecamatan
            $table->string('schedule_day')->nullable(); // Hari pelayanan, cth: "Setiap Selasa"
            $table->string('schedule_time')->nullable(); // Jam pelayanan, cth: "08:00 - 11:00"
            $table->string('contact_person')->nullable(); // Nama Kader/Penanggung Jawab
            $table->string('phone_number')->nullable(); // No. Telepon Kader
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posyandus');
    }
};
