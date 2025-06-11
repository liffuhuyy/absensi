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
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Helper render view agar lebih ringkas dan konsisten
    protected function renderView($view, $data = [])
    {
        if (view()->exists($view)) {
            return view($view, $data);
        }
        abort(404, 'View tidak ditemukan.');
    }
public function prosesReset(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required|email',
        'new_password' => 'required|min:6|confirmed',
    ]);

    // Cari user berdasarkan email
    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }

    // Update password
    $user->password = \Hash::make($request->new_password);
    $user->save();

    return redirect()->route('ubahkatasandiberhasil')->with('status', 'Password berhasil direset.');
}

    // Login form
    public function showLoginForm()
    {
        return $this->renderView('absensi.login');
    }

    // Login process
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            return match ($user->role) {
                'admin' => redirect()->route('dashboardmin'),
                'user' => redirect()->route('beranda'),
                'perusahaan' => redirect()->route('dashboardpt'),
                default => tap(Auth::logout(), fn() => redirect()->route('login')->withErrors(['role' => 'Role tidak dikenali.']))
            };
        }

        return back()->withErrors([
            'login' => 'Email atau password salah.'
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Contoh fungsi view menggunakan helper renderView
    public function dashboardmin() { return $this->renderView('admin.dashboardmin'); }
    public function ringkasanabsen() { return $this->renderView('admin.ringkasanabsen'); }
    public function datapt() { return $this->renderView('admin.datapt'); }
    public function pengguna() { return $this->renderView('admin.pengguna'); }
    public function datapembimbing() { return $this->renderView('admin.datapembimbing'); }
    public function managementakses() { return $this->renderView('admin.managementakses'); }
    public function pengaturan() { return $this->renderView('admin.pengaturan'); }

    public function dashboardpt() { return $this->renderView('perusahaan.dashboardpt'); }
    public function pengaturanpt() { return $this->renderView('perusahaan.pengaturanpt'); }
    public function nilai() { return $this->renderView('perusahaan.nilai'); }
    public function profilpt() { return $this->renderView('perusahaan.profilpt'); }
    public function ringkasanabsenpt() { return $this->renderView('perusahaan.ringkasanabsenpt'); }
    public function jadwalpt() { return $this->renderView('perusahaan.jadwalpt'); }
    public function managementaksespt() { return $this->renderView('perusahaan.managementaksespt'); }
    public function backupdatapt() { return $this->renderView('perusahaan.backupdatapt'); }

    public function beranda() { return $this->renderView('absensi.beranda'); }
    public function presensi() { return $this->renderView('absensi.presensi'); }
    public function biodata() { return $this->renderView('absensi.biodata'); }
    public function izinsakit() { return $this->renderView('absensi.izinsakit'); }
    public function riwayatabsen() { return $this->renderView('absensi.riwayatabsen'); }
    public function editprofil() { return $this->renderView('absensi.editprofil'); }
    public function profil() {
        $biodata = Biodata::whereNotNull('nohp')->get();
        return $this->renderView('absensi.profil', compact('biodata'));
    }
    public function pengajuan1() { return $this->renderView('absensi.pengajuan1'); }
    public function magang() { return $this->renderView('absensi.magang'); }
    public function kontak() { return $this->renderView('absensi.kontak'); }
    public function resetkatasandi() { return $this->renderView('absensi.resetkatasandi'); }
    public function ubahkatasandiberhasil() { return $this->renderView('absensi.ubahkatasandiberhasil'); }
    public function lupakatasandi() { return $this->renderView('absensi.lupakatasandi'); }
    public function ubahkatasandi() { return $this->renderView('absensi.ubahkatasandi'); }
    public function index() { return $this->renderView('absensi.index'); }
    public function tentangkami() { return $this->renderView('absensi.tentangkami'); }

    // Manajemen tugas
    public function showTugas()
    {
        $tugas = UserTugas::all();
        return $this->renderView('absensi.manajementugas', compact('tugas'));
=======
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
>>>>>>> 84e2654294087cac1211415410a44418b73f26ad
    }

    public function filter(Request $request)
    {
<<<<<<< HEAD
        $request->validate(['bulan' => 'required|digits:2']);
        $bulan = $request->bulan;
        $tugas = UserTugas::whereMonth('tanggal', $bulan)->get();

        return $this->renderView('absensi.manajementugas', compact('tugas', 'bulan'));
=======
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $bulan = $request->bulan;
        $tugas = UserTugas::whereMonth('tanggal', $bulan)->get();
        return view('absensi.manajementugas', compact('tugas', 'bulan'));
>>>>>>> 84e2654294087cac1211415410a44418b73f26ad
    }

    public function simpanTugas(Request $request)
    {
<<<<<<< HEAD
        $request->validate([
            'tanggal' => 'required|date',
            'tugas' => 'required|string|max:255'
=======
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'tugas' => 'required|string|max:255',
>>>>>>> 84e2654294087cac1211415410a44418b73f26ad
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

<<<<<<< HEAD
    // Pengajuan untuk perusahaan dan user (contoh)
    public function showPengajuan1()
    {
        $pengajuan = Pengajuan::paginate(10);
        return $this->renderView('absensi.magang', compact('pengajuan'));
    }

    public function pengajuanpt()
    {
        $pengajuan = Pengajuan::all();
        return $this->renderView('perusahaan.pengajuanpt', compact('pengajuan'));
    }

    // Notifikasi admin
    public function showNotif()
    {
        $notifikasi = Notifikasi::orderBy('created_at', 'desc')->get();
        return $this->renderView('admin.notif', compact('notifikasi'));
    }

    public function storeNotif(Request $request)
=======
    // === Reset Password ===

    public function showForgotForm()
    {
        return view('absensi.lupakatasandi');  // perbaikan typo
    }

    public function kirimLinkReset(Request $request)
>>>>>>> 84e2654294087cac1211415410a44418b73f26ad
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

<<<<<<< HEAD
    public function destroy($id)
    {
        $notifikasi = Notifikasi::find($id);
        if (!$notifikasi) {
            return redirect()->back()->with('error', 'Notifikasi tidak ditemukan.');
        }
        $notifikasi->delete();
        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus!');
    }
}
=======
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
>>>>>>> 84e2654294087cac1211415410a44418b73f26ad
