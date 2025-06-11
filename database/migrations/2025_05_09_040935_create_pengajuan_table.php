<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengguna_id');
            $table->string('nama');// Nama
            $table->string('jurusan'); // Jurusan
            $table->date('tanggal_masuk'); // Tanggal masuk
            $table->date('tanggal_keluar')->nullable(); // Tanggal keluar (bisa null)            
            $table->unsignedBigInteger('perusahaan_id');
            $table->string('status')->default('Menunggu');
            $table->timestamps();

            $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
            $table->foreign('perusahaan_id')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
};