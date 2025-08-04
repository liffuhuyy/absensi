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
<<<<<<< HEAD
use Illuminate\Support\Facades\Session;
=======
use App\Http\Middleware\RoleMiddleware;

>>>>>>> 44734077802f2dac236b168425133a99aa31d034
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
<<<<<<< HEAD
    // FORM LOGIN
    public function showLoginForm()
    {
        return view('absensi.login');
    }

    // HALAMAN INDEX
=======

    public function showLoginForm()
    {
        if (!view()->exists('absensi.login')) {
            abort(404, 'Halaman login tidak ditemukan.');
        }

        return view('absensi.login');
    }

>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    public function index()
    {
        return view('absensi.index');
    }

    // TENTANG KAMI
    public function tentangkami()
    {
        return view('absensi.tentangkami');
    }

    // CEK MIDDLEWARE
    public function testMiddleware()
    {
        return Auth::check() ? 'User sudah login!' : 'User belum login!';
    }

<<<<<<< HEAD
    // BERANDA ADMIN
    public function dashboardmin()
    {
        return view('admin.dashboardmin');
    }

    // BERANDA PERUSAHAAN
    public function dashboardpt()
    {
        return view('perusahaan.dashboardpt');
    }

    public function ringkasanabsenpt()
    {
        return view('perusahaan.ringkasanabsenpt');
    }

    // RIWAYAT ABSEN
    public function riwayatabsen()
    {
        return view('absensi.riwayatabsen');
    }

    // FORM LUPA KATA SANDI
    public function lupakatasandi()
    {
        return view('absensi.lupakatasandi');
    }

    // FORM RESET KATA SANDI
    public function resetkatasandi()
    {
        return view('absensi.resetkatasandi');
    }

    // ========================
    // LOGIN LOGIC
    // ========================
    public function login(Request $request)
    {
=======

    // LOGIN DAN DAFTAR
    public function login(Request $request)
    {
        // Validasi input agar lebih aman
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        $user = Pengguna::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
<<<<<<< HEAD
            Auth::login($user);

            return match ($user->role) {
                'admin'      => redirect()->route('dashboardmin'),
                'user'       => redirect()->route('beranda'),
                'perusahaan' => redirect()->route('dashboardpt'),
                default      => tap(Auth::logout(), fn () => redirect()->route('login')->withErrors(['role' => 'Role tidak dikenali.']))
=======
            Auth::login($user); // Login user

            // Arahkan ke halaman berdasarkan role
            return match ($user->role) {
                'admin' => redirect()->route('dashboardmin'),
                'user' => redirect()->route('beranda'),
                'perusahaan' => redirect()->route('dashboardpt'),
                default => tap(Auth::logout(), fn() => redirect()->route('login')->withErrors(['role' => 'Role tidak dikenali.']))
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
            };
        }

        return redirect()->route('login')->withErrors(['login' => 'Email atau password salah.']);
    }

<<<<<<< HEAD
    // LOGOUT
=======
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

<<<<<<< HEAD
    // ========================
    // RESET PASSWORD
    // ========================

=======



    // RESET PASSWORD
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
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

<<<<<<< HEAD
    // Proses ubah password
    public function prosesReset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
=======
    // ✅ Proses ubah password (SUDAH DIBENARKAN)
    public function prosesReset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
        ]);

        $email = session('reset_email');
        $user = Pengguna::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('lupakatasandi')->withErrors(['email' => 'Email tidak valid.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget('reset_email');

<<<<<<< HEAD
        return redirect()->route('ubahkatasandiberhasil');
=======
        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login kembali.');
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    }
}
