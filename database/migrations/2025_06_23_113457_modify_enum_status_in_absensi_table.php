<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("ALTER TABLE absensi MODIFY COLUMN status ENUM('Hadir', 'Terlambat', 'Izin', 'Sakit', 'Tanpa Keterangan') DEFAULT 'Tanpa Keterangan'");
    }

    public function down()
    {
        // Optional: rollback ke enum lama jika dibutuhkan
        DB::statement("ALTER TABLE absensi MODIFY COLUMN status ENUM('Hadir', 'Terlambat', 'Izin', 'Tanpa Keterangan') DEFAULT 'Tanpa Keterangan'");
    }
};
