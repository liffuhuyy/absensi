<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('hari_libur', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->string('keterangan')->nullable();
        $table->timestamps();
    });
}

      public function down(): void
    {
        Schema::dropIfExists('hari_libur');
    }
};
