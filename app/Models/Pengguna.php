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
<<<<<<< HEAD


=======
    public function biodata()
    {
        return $this->hasOne(Biodata::class, 'pengguna_id');
    }
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
}
