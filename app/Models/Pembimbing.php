<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembimbing extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel di database
     */
    protected $table = 'pembimbing';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'nama',
        'nip',
        'jurusan',
        'kelas',
        'no_hp',
        'email',
    ];

    /**
     * Field yang disembunyikan saat serialization
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relasi dengan siswa (one to many)
     * Satu pembimbing bisa membimbing banyak siswa
     */
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'pembimbing_id');
    }

    /**
     * Relasi dengan kelas (many to many)
     * Satu pembimbing bisa mengajar di beberapa kelas
     */
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'pembimbing_kelas', 'pembimbing_id', 'kelas_id');
    }

    /**
     * Scope untuk filter berdasarkan jurusan
     */
    public function scopeByJurusan($query, $jurusan)
    {
        return $query->where('jurusan', $jurusan);
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('nip', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    /**
     * Accessor untuk format nama
     */
    public function getNamaLengkapAttribute()
    {
        return $this->nama . ' (' . $this->nip . ')';
    }

    /**
     * Accessor untuk format jurusan
     */
    public function getJurusanLengkapAttribute()
    {
        $jurusan_map = [
            'RPL' => 'Rekayasa Perangkat Lunak',
            'TKJ' => 'Teknik Komputer dan Jaringan',
            'MM' => 'Multimedia',
            'OTKP' => 'Otomatisasi dan Tata Kelola Perkantoran',
            'AKL' => 'Akuntansi dan Keuangan Lembaga',
            'BDP' => 'Bisnis Daring dan Pemasaran'
        ];

        return $jurusan_map[$this->jurusan] ?? $this->jurusan;
    }
}