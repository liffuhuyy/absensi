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
            $table->string('nama');// Nama
            $table->string('jurusan'); // Jurusan
            $table->date('tanggal_masuk'); // Tanggal masuk
            $table->date('tanggal_keluar')->nullable(); // Tanggal keluar (bisa null)
            $table->string('perusahaan'); // Nama perusahaan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
};