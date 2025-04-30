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



 //ADMIN
    public function dashboardmin()
    {
        if (view()->exists('admin.dashboardmin')) {
            return view('admin.dashboardmin');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function ringkasanabsen()
    {
        if (view()->exists('admin.ringkasanabsen')) {
            return view('admin.ringkasanabsen');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function managementpengguna()
    {
        if (view()->exists('admin.managementpengguna')) {
            return view('admin.managementpengguna');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function managementakses()
    {
        if (view()->exists('admin.managementakses')) {
            return view('admin.managementakses');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function notif()
    {
        if (view()->exists('admin.notif')) {
            return view('admin.notif');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function pengaturan()
    {
        if (view()->exists('admin.pengaturan')) {
            return view('admin.pengaturan');
        } else {
            return "View tidak ditemukan.";
        }
    }



    //PERUSAHAAN
    public function dashboardpt()
    {
        if (view()->exists('perusahaan.dashboardpt')) {
            return view('perusahaan.dashboardpt');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function pengaturanpt()
    {
        if (view()->exists('perusahaan.pengaturanpt')) {
            return view('perusahaan.pengaturanpt');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function nilai()
    {
        if (view()->exists('perusahaan.nilai')) {
            return view('perusahaan.nilai');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function profilpt()
    {
        if (view()->exists('perusahaan.profilpt')) {
            return view('perusahaan.profilpt');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function ringkasanabsenpt()
    {
        if (view()->exists('perusahaan.ringkasanabsenpt')) {
            return view('perusahaan.ringkasanabsenpt');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function pengajuanpt()
    {
        if (view()->exists('perusahaan.pengajuanpt')) {
            return view('perusahaan.pengajuanpt');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function jadwalpt()
    {
        if (view()->exists('perusahaan.jadwalpt')) {
            return view('perusahaan.jadwalpt');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function managementaksespt()
    {
        if (view()->exists('perusahaan.managementaksespt')) {
            return view('perusahaan.managementaksespt');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function managementpenggunapt()
    {
        if (view()->exists('perusahaan.managementpenggunapt')) {
            return view('perusahaan.managementpenggunapt');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function backupdatapt()
    {
        if (view()->exists('perusahaan.backupdatapt')) {
            return view('perusahaan.backupdatapt');
        } else {
            return "View tidak ditemukan.";
        }
    }



    //LOGIN DAN DAFTAR
    public function loginpt()
    {
        if (view()->exists('perusahaan.loginpt')) {
            return view('perusahaan.loginpt');
        } else {
            return "View tidak ditemukan.";
        }
    }
    public function daftarpt()
    {
        if (view()->exists('perusahaan.daftarpt')) {
            return view('perusahaan.daftarpt');
        } else {
            return "View tidak ditemukan.";
        }
    }

}
