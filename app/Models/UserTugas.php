<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTugas extends Model
{
    protected $table = 'user_tugas';
    protected $fillable = ['tanggal', 'tugas'];
}
