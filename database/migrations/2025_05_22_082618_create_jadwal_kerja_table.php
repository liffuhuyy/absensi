<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('jadwal_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->json('hari_kerja'); // Format array JSON untuk menyimpan hari kerja
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_kerja');
    }
};