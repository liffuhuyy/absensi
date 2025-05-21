<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model {
    protected $table = 'notifikasi';
    protected $fillable = ['id','name', 'email', 'message'];
    public $timestamps = true;
}


