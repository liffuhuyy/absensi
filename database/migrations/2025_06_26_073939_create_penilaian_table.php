<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengguna_id');
            $table->string('nama');
            $table->string('nisn');
            $table->date('tanggal_keluar');
            $table->integer('nilai')->nullable(); // Nilai bisa null jika belum dinilai
            $table->text('keterangan')->nullable(); // Keterangan tambahan jika ada
            $table->timestamps();

            $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
