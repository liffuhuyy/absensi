<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';
    protected $fillable = [
        'pengguna_id',
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function isUser()
    {
        return $this->role === 'user';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPerusahaan()
    {
        return $this->role === 'perusahaan';
    }



    public function biodata()
    {
        return $this->hasOne(Biodata::class, 'pengguna_id');
    }
    public function jadwalKerja()
    {
        return $this->hasMany(JadwalKerja::class, 'pengguna_id', 'pengguna_id');
    }

    public function pengajuan()
    {
        return $this->hasOne(Pengajuan::class, 'pengguna_id');
        // Ganti ke ->hasMany(...) jika satu pengguna bisa punya banyak pengajuan
    }
}
