<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $fillable = ['id','nama', 'jurusan', 'tanggal_masuk', 'tanggal_keluar', 'perusahaan', 'status']; 
    protected $dates = ['created_at', 'updated_at'];

}
