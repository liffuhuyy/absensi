<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'pengguna_id',
        'tanggal',
        'absen_masuk',
        'absen_pulang',
        'pulang_awal',
        'keterangan',
        'lokasi_masuk_latitude',
        'lokasi_masuk_longitude',
        'lokasi_pulang_latitude',
        'lokasi_pulang_longitude',
        'status'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}