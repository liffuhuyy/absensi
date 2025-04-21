<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (view()->exists('products.login')) {
            return view('products.login');
        } else {
            return "View login tidak ditemukan.";
        }
    }
    public function editprofil()
    {
        if (view()->exists('products.editprofil')) {
            return view('products.editprofil');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function biodata()
    {
        if (view()->exists('products.biodata')) {
            return view('products.biodata');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function izinsakit()
    {
        if (view()->exists('products.izinsakit')) {
            return view('products.izinsakit');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function riwayatabsen()
    {
        if (view()->exists('products.riwayatabsen')) {
            return view('products.riwayatabsen');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function presensi()
    {
        if (view()->exists('products.presensi')) {
            return view('products.presensi');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function showBerandaform()
    {
        if (view()->exists('products.beranda')) {
            return view('products.beranda');
        } else {
            return "View beranda tidak ditemukan.";
        }
    }

    public function manajementugas()
    {
        if (view()->exists('products.manajementugas')) {
            return view('products.manajementugas');
        } else {
            return "View tidak ditemukan.";
        }
    }

    
    public function pengajuan()
    {
        if (view()->exists('products.pengajuan')) {
            return view('products.pengajuan');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function kontak()
    {
        if (view()->exists('products.kontak')) {
            return view('products.kontak');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function profil()
    {
        if (view()->exists('products.profil')) {
            return view('products.profil');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function index()
    {
        if (view()->exists('products.index')) {
            return view('products.index');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function tentangkami()
    {
        if (view()->exists('products.tentangkami')) {
            return view('products.tentangkami');
        } else {
            return "View tidak ditemukan.";
        }
    }

    // Menampilkan halaman daftar
    public function showRegisterForm()
    {
        return view('products.daftar'); // Tampilkan daftar.blade.php
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Login berhasil
            return redirect()->intended('/dashboard'); // Ganti dengan rute yang sesuai
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
