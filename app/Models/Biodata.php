<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';
    protected $fillable = [
        'id', 'nama', 'nisn', 'nohp', 'email', 'jenis_kelamin', 'tempat_lahir',
        'tanggal_lahir', 'jurusan', 'kelas', 'agama', 'alamat'
    ];
}
