<?php

namespace App\Http\Controllers;

//import model product
use App\Models\absensi; 

//import return type View
use Illuminate\View\View;

class absensiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function showLoginForm() : View
    {
        return view('login'); // Pastikan view bernama "login"
    }
    
    public function register() : View
    {
        return view('daftar'); // Pastikan view bernama "daftar"
    }

    public function beranda() : View
    {
        if (!view()->exists('absensi.beranda')) {
            abort(404, 'Halaman beranda tidak ditemukan.');
        }
        return view('absensi.beranda');
    }
    
    public function presensi() : View
    {
        return view('presensi'); 
    }
    
    public function menajementugas() : View
    {
        return view('manajementugas'); 
    }

    public function pengajuan() : View
    {
        return view('pengajuan'); 
    }

    public function kontak() : View
    {
        return view('kontak'); 
    }

    public function profil() : View
    {
        return view('profil'); 
    }
    
    public function izinsakit() : View
    {
        return view('izinsakit'); 
    }

    public function riwayatabsen() : View
    {
        return view('riwayatabsen'); 
    }

    public function biodata() : View
    {
        return view('biodata'); 
    }

    public function editprofil() : View
    {
        return view('absensi.editprofil'); 
    }

    public function index() : View
    {
        return view('absensi.index'); 
<<<<<<< HEAD
=======
        return view('absensi.index'); 
>>>>>>> 024fa2612cf0548aa04f2e9fa1c9d7ea28a096ec
    }

    public function tentangkami() : View
    {
        return view('tentangkami'); 
    }
}