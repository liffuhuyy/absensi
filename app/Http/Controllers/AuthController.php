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
use Illuminate\Support\Str;
use Carbon\Carbon;

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

    public function biodata()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return $this->loadView('absensi.biodata');
    }

    // ... (halaman lain yang perlu auth bisa ditambah pengecekan sama)

    public function profil()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $biodata = Biodata::whereNotNull('nohp')->get();
        return view('absensi.profil', compact('biodata'));
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

    public function filter(Request $request)
    {
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

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // === Helper ===

    private function loadView($view, $errorMsg = 'View tidak ditemukan.')
    {
        if (view()->exists($view)) {
            return view($view);
        }
        // Redirect ke halaman error 404 atau halaman khusus
        abort(404, $errorMsg);
    }
}
