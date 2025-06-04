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
        Schema::create('pembimbing', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('nip', 20)->unique();
            $table->enum('jurusan', ['RPL', 'TKJ', 'MM', 'OTKP', 'AKL', 'BDP']);
            $table->string('kelas', 50);
            $table->string('no_hp', 15);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            
            // Index untuk pencarian yang lebih cepat
            $table->index(['nama', 'nip', 'jurusan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing');
    }
};