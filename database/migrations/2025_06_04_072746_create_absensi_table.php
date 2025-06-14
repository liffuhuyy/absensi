<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengguna_id');
            $table->date('tanggal')->nullable(); // Menyimpan tanggal absensi
            $table->time('absen_masuk')->nullable(); // Menyimpan waktu masuk tanpa tanggal
            $table->time('absen_pulang')->nullable(); // Menyimpan waktu pulang tanpa tanggal
            $table->boolean('pulang_awal')->default(false); // Menandai pulang lebih awal
            $table->string('keterangan')->nullable();
            $table->decimal('lokasi_masuk_latitude', 10, 7)->nullable(); // Koordinat lokasi masuk
            $table->decimal('lokasi_masuk_longitude', 10, 7)->nullable(); // Koordinat lokasi masuk
            $table->decimal('lokasi_pulang_latitude', 10, 7)->nullable(); // Koordinat lokasi pulang
            $table->decimal('lokasi_pulang_longitude', 10, 7)->nullable(); // Koordinat lokasi pulang
            $table->enum('status', ['Hadir', 'Terlambat', 'Izin', 'Tanpa Keterangan'])->default('Tanpa Keterangan');
            $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('absensi');
    }
};