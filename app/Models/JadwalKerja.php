<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Model;

class JadwalKerja extends Model
{
    protected $table = 'jadwal_kerja';
    protected $fillable = [
        'pengguna_id',
        'jam_masuk',
        'jam_keluar',
        'hari_kerja',
        'latitude',
        'longitude'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
