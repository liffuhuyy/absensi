<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up() {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengguna_id');
            $table->dateTime('absen_masuk')->nullable();
            $table->dateTime('absen_pulang')->nullable();
            $table->boolean('pulang_awal')->default(false); // Menandai pulang lebih awal
            $table->string('alasan_pulang_cepat')->nullable(); // Alasan pulang lebih awal
            $table->decimal('lokasi_masuk_latitude', 10, 7)->nullable();
            $table->decimal('lokasi_masuk_longitude', 10, 7)->nullable();
            $table->decimal('lokasi_pulang_latitude', 10, 7)->nullable();
            $table->decimal('lokasi_pulang_longitude', 10, 7)->nullable();
            $table->enum('status', ['Hadir', 'Terlambat', 'Izin', 'Tanpa Keterangan'])->default('Tanpa Keterangan');
            $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('absensi');
    }

};