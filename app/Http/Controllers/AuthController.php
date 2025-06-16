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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Str;
use Carbon\Carbon;
=======
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79

class AuthController extends Controller
{
    // === Umum ===

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return $this->loadView('absensi.index');
    }

    public function beranda()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return $this->loadView('absensi.beranda');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            // Kalau sudah login, redirect ke halaman sesuai role
            $role = Auth::user()->role;
            return match ($role) {
                'admin' => redirect()->route('dashboardmin'),
                'user' => redirect()->route('beranda'),
                'perusahaan' => redirect()->route('dashboardpt'),
                default => redirect()->route('login'),
            };
        }
        return $this->loadView('absensi.login');
    }

    public function editprofil()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return $this->loadView('absensi.editprofil');
    }



    // === Manajemen Tugas ===

    public function showTugas()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $tugas = UserTugas::all();
        return view('absensi.manajementugas', compact('tugas'));
    }

    public function showLoginForm()
    {
<<<<<<< HEAD
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $bulan = $request->bulan;
        $tugas = UserTugas::whereMonth('tanggal', $bulan)->get();
        return view('absensi.manajementugas', compact('tugas', 'bulan'));
    }

    public function simpanTugas(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'tugas' => 'required|string|max:255',
        ]);

        try {
            UserTugas::create([
                'tanggal' => $request->tanggal,
                'tugas' => $request->tugas
            ]);
            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // === Reset Password ===

    public function showForgotForm()
    {
        return view('absensi.lupakatasandi');  // perbaikan typo
    }


    public function biodata()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return $this->loadView('absensi.biodata');
    }

    public function izinsakit()
    {
        if (view()->exists('absensi.izinsakit')) {
            return view('absensi.izinsakit');
        } else {
            return "View tidak ditemukan.";
        }
    }
=======
        if (!view()->exists('absensi.login')) {
            abort(404, 'Halaman login tidak ditemukan.');
        }

        return view('absensi.login');
    }

>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79

    public function riwayatabsen()
    {
        if (view()->exists('absensi.riwayatabsen')) {
            return view('absensi.riwayatabsen');
        } else {
            return "View tidak ditemukan.";
        }
    }

<<<<<<< HEAD
    public function presensi()
    {
        if (view()->exists('absensi.presensi')) {
            return view('absensi.presensi');
        } else {
            return "View tidak ditemukan.";
        }
    }




    public function showPengajuan1()
    {
        $pengajuan = Pengajuan::paginate(10);
        return view('absensi.magang', compact('pengajuan'));
    }

    public function pengajuan1()
    {
        if (view()->exists('absensi.pengajuan1')) {
            return view('absensi.pengajuan1');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function magang()
    {
        if (view()->exists('absensi.magang')) {
            return view('absensi.magang');
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
=======
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79

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

<<<<<<< HEAD
    public function profil()
    {
        $biodata = Biodata::whereNotNull('nohp')->get();
        return view('absensi.profil', compact('biodata'));
    }

=======
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79



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

    public function ringkasanabsen()
    {
        if (view()->exists('admin.ringkasanabsen')) {
            return view('admin.ringkasanabsen');
        } else {
            return "View tidak ditemukan.";
        }
    }

<<<<<<< HEAD
    public function datapt()
    {
        if (view()->exists('admin.datapt')) {
            return view('admin.datapt');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function pengguna()
    {
        if (view()->exists('admin.pengguna')) {
            return view('admin.pengguna');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function datapembimbing()
    {
        if (view()->exists('admin.datapembimbing')) {
            return view('admin.datapembimbing');
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

    public function storeNotif(Request $request) {}

    public function kirimLinkReset(Request $request)

    {
        $request->validate([
            'email' => 'required|email|exists:penggunas,email', // pastikan tabel dan kolom benar
        ]);

        // Hapus token lama jika ada
        DB::table('password_resets')->where('email', $request->email)->delete();

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('absensi.email_reset', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email)->subject('Reset Kata Sandi');
        });

        return back()->with('status', 'Link reset telah dikirim ke email kamu.');
    }

    public function formResetKataSandi($token)
    {
        return view('absensi.resetkatasandi', ['token' => $token]);
    }

    public function prosesResetKataSandi(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:penggunas,email', // pastikan tabel sesuai
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required'
        ]);

        $reset = DB::table('password_resets')->where([
            ['email', $request->email],
            ['token', $request->token],
        ])->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Token tidak valid atau sudah kadaluarsa.']);
        }

        // Token valid hanya 60 menit (optional)
        $tokenCreated = Carbon::parse($reset->created_at);
        if (Carbon::now()->diffInMinutes($tokenCreated) > 60) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'Token reset telah kadaluarsa. Silakan coba lagi.']);
        }

        DB::table('penggunas')->where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_resets')->where('email', $request->email)->delete();
=======
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79

        return redirect()->route('login')->with('status', 'Password berhasil diubah!');
    }

    // === LOGIN / LOGOUT ===

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

<<<<<<< HEAD
=======
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
        // Validasi input agar lebih aman
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        $user = Pengguna::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user); // Login user

            // Arahkan ke halaman berdasarkan role
            return match ($user->role) {
                'admin' => redirect()->route('dashboardmin'),
                'user' => redirect()->route('beranda'),
                'perusahaan' => redirect()->route('dashboardpt'),
                default => tap(Auth::logout(), fn() => redirect()->route('login')->withErrors(['role' => 'Role tidak dikenali.']))
            };
        }

        return redirect()->route('login')->withErrors(['login' => 'Email atau password salah.']);
    }

>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
<<<<<<< HEAD

    // === Helper ===

    private function loadView($view, $errorMsg = 'View tidak ditemukan.')
    {
        if (view()->exists($view)) {
            return view($view);
        }
        // Redirect ke halaman error 404 atau halaman khusus
        abort(404, $errorMsg);
    }
=======
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
}
