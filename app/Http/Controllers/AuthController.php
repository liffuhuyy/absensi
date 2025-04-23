<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (view()->exists('absensi.login')) {
            return view('absensi.login');
        } else {
            return "View login tidak ditemukan.";
        }
    }
    public function editprofil()
    {
        if (view()->exists('absensi.editprofil')) {
            return view('absensi.editprofil');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function biodata()
    {
        if (view()->exists('absensi.biodata')) {
            return view('absensi.biodata');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function izinsakit()
    {
        if (view()->exists('absensi.izinsakit')) {
            return view('absensi.izinsakit');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function riwayatabsen()
    {
        if (view()->exists('absensi.riwayatabsen')) {
            return view('absensi.riwayatabsen');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function presensi()
    {
        if (view()->exists('absensi.presensi')) {
            return view('absensi.presensi');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function showBerandaform()
    {
        if (view()->exists('absensi.beranda')) {
            return view('absensi.beranda');
        } else {
            return "View beranda tidak ditemukan.";
        }
    }

    public function manajementugas()
    {
        if (view()->exists('absensi.manajementugas')) {
            return view('absensi.manajementugas');
        } else {
            return "View tidak ditemukan.";
        }
    }

    
    public function pengajuan()
    {
        if (view()->exists('absensi.pengajuan')) {
            return view('absensi.pengajuan');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function kontak()
    {
        if (view()->exists('absensi.kontak')) {
            return view('absensi.kontak');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function resetkatasandi()
    {
        if (view()->exists('absensi.resetkatasandi')) {
            return view('absensi.resetkatasandi');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function ubahkatasandiberhasil()
    {
        if (view()->exists('absensi.ubahkatasandiberhasil')) {
            return view('absensi.ubahkatasandiberhasil');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function lupakatasandi()
    {
        if (view()->exists('absensi.lupakatasandi')) {
            return view('absensi.lupakatasandi');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function ubahkatasandi()
    {
        if (view()->exists('absensi.ubahkatasandi')) {
            return view('absensi.ubahkatasandi');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function profil()
    {
        if (view()->exists('absensi.profil')) {
            return view('absensi.profil');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function index()
    {
        if (view()->exists('absensi.index')) {
            return view('absensi.index');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function tentangkami()
    {
        if (view()->exists('absensi.tentangkami')) {
            return view('absensi.tentangkami');
        } else {
            return "View tidak ditemukan.";
        }
    }

    // Menampilkan halaman daftar
    public function showRegisterForm()
    {
        return view('absensi.daftar'); // Tampilkan daftar.blade.php
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
