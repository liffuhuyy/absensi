<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('jadwal_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('pengguna')->onDelete('cascade'); // Relasi ke tabel pengguna
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->json('hari_kerja'); // Menyimpan hari kerja dalam format JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_kerja');
    }
};

