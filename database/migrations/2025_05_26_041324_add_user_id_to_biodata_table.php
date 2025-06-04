<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('biodata', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->after('id'); // atau di posisi yang diinginkan
    });
}

public function down()
{
    Schema::table('biodata', function (Blueprint $table) {
        $table->dropColumn('user_id');
    });
}


   
};
