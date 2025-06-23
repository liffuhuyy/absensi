<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pengguna;
use App\Models\JadwalKerja;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $fillable = ['pengguna_id', 'nama', 'jurusan', 'tanggal_masuk', 'tanggal_keluar', 'perusahaan_id', 'status'];
    protected $dates = ['created_at', 'updated_at'];

    public function perusahaan()
    {
        return $this->belongsTo(\App\Models\Pengguna::class, 'perusahaan_id');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalKerja::class, 'pengguna_id', 'perusahaan_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
