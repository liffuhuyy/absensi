<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalKerja extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kerja';

    protected $fillable = ['user_id', 'jam_masuk', 'jam_keluar', 'hari_kerja'];

    protected $casts = [
        'hari_kerja' => 'array' // Mengubah JSON menjadi array otomatis
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'user_id');
    }
}
