<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan'; // Nama tabel
    protected $fillable = ['id','nama', 'jurusan', 'tanggal_masuk', 'tanggal_keluar', 'perusahaan']; // Kolom yang bisa diisi
}
