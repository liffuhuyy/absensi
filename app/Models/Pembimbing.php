<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pembimbing extends Model
{
    use HasFactory;


    protected $table = 'pembimbing';
    
    protected $fillable = [
        'nama',
        'nip',
        'jurusan',
        'kelas',
        'no_hp',
        'email'
    ];
    
}