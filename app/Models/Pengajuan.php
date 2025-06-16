<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
<<<<<<< HEAD
=======
use App\Models\Pengguna;
use App\Models\JadwalKerja;
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
<<<<<<< HEAD
    protected $fillable = ['nama', 'jurusan', 'tanggal_masuk', 'tanggal_keluar', 'perusahaan', 'status'];
    protected $dates = ['created_at', 'updated_at'];
    
=======
    protected $fillable = ['pengguna_id', 'nama', 'jurusan', 'tanggal_masuk', 'tanggal_keluar', 'perusahaan_id', 'status'];
    protected $dates = ['created_at', 'updated_at'];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalKerja::class, 'pengguna_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
}
