<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTugas;
use App\Models\Pengguna;
use App\Models\Absensi;
use App\Models\Biodata;
use App\Models\Notifikasi;
use App\Models\Pengajuan;
use App\Models\JadwalKerja;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (!view()->exists('absensi.login')) {
            abort(404, 'Halaman login tidak ditemukan.');
        }

        return view('absensi.login');
    }

    public function riwayatabsen()
    {
        if (view()->exists('absensi.riwayatabsen')) {
            return view('absensi.riwayatabsen');
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


    public function lupakatasandi()
    {
        if (view()->exists('absensi.lupakatasandi')) {
            return view('absensi.lupakatasandi');
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

    public function testMiddleware()
    {
        if (Auth::check()) {
            return "User sudah login!";
        } else {
            return "User belum login!";
        }
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


    //PERUSAHAAN
    public function dashboardpt()
    {
        if (view()->exists('perusahaan.dashboardpt')) {
            return view('perusahaan.dashboardpt');
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

    // LOGIN DAN DAFTAR
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        $user = Pengguna::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            return match ($user->role) {
                'admin' => redirect()->route('dashboardmin'),
                'user' => redirect()->route('beranda'),
                'perusahaan' => redirect()->route('dashboardpt'),
                default => tap(Auth::logout(), fn() => redirect()->route('login')->withErrors(['role' => 'Role tidak dikenali.']))
            };
        }

        return redirect()->route('login')->withErrors(['login' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // ========================
    // RESET PASSWORD
    // ========================

    // Form input email
    public function showFormEmail()
    {
        return view('absensi.lupakatasandi');
    }

    // Cek email yang dimasukkan
    public function cekEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Pengguna::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        session(['reset_email' => $request->email]);

        return redirect()->route('resetkatasandi');
    }

    // Tampilkan form reset password
    public function showFormReset()
    {
        if (!session()->has('reset_email')) {
            return redirect()->route('lupakatasandi')->withErrors(['email' => 'Silakan masukkan email terlebih dahulu.']);
        }

        return view('absensi.resetkatasandi');
    }

    // ✅ Proses ubah password (SUDAH DIBENARKAN)
    public function prosesReset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = session('reset_email');
        $user = Pengguna::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('lupakatasandi')->withErrors(['email' => 'Email tidak valid.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget('reset_email');

        // ✅ Langsung tampilkan view yang tersedia
        return redirect()->route('ubahkatasandiberhasil');
    }
}
