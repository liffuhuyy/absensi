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
        return $this->loadView('absensi.index');
    }

    public function beranda()
    {
        return $this->loadView('absensi.beranda');
    }

    public function showLoginForm()
    {
        return $this->loadView('absensi.login', 'Halaman login tidak ditemukan.');
    }

    public function editprofil()
    {
        return $this->loadView('absensi.editprofil');
    }

    public function biodata()
    {
        return $this->loadView('absensi.biodata');
    }

    public function izinsakit()
    {
        return $this->loadView('absensi.izinsakit');
    }

    public function riwayatabsen()
    {
        return $this->loadView('absensi.riwayatabsen');
    }

    public function presensi()
    {
        return $this->loadView('absensi.presensi');
    }

    public function kontak()
    {
        return $this->loadView('absensi.kontak');
    }

    public function resetkatasandi()
    {
        return $this->loadView('absensi.resetkatasandi');
    }

    public function ubahkatasandiberhasil()
    {
        return $this->loadView('absensi.ubahkatasandiberhasil');
    }

    public function lupakatasandi()
    {
        return $this->loadView('absensi.lupakatasandi');
    }

    public function ubahkatasandi()
    {
        return $this->loadView('absensi.ubahkatasandi');
    }

    public function tentangkami()
    {
        return $this->loadView('absensi.tentangkami');
    }

    public function profil()
    {
        $biodata = Biodata::whereNotNull('nohp')->get();
        return view('absensi.profil', compact('biodata'));
    }

    public function testMiddleware()
    {
        return Auth::check() ? "User sudah login!" : "User belum login!";
    }

    // === Manajemen Tugas ===

    public function showTugas()
    {
        $tugas = UserTugas::all();
        return view('absensi.manajementugas', compact('tugas'));
    }

    public function filter(Request $request)
    {
        $bulan = $request->bulan;
        $tugas = UserTugas::whereMonth('tanggal', $bulan)->get();
        return view('absensi.manajementugas', compact('tugas', 'bulan'));
    }

    public function simpanTugas(Request $request)
    {
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

    // === Pengajuan & Magang ===

    public function pengajuan1()
    {
        return $this->loadView('absensi.pengajuan1');
    }

    public function magang()
    {
        return $this->loadView('absensi.magang');
    }

    public function showPengajuan1()
    {
        $pengajuan = Pengajuan::paginate(10);
        return view('absensi.magang', compact('pengajuan'));
    }

    // === Reset Password ===

    public function showForgotForm()
{
    return view('absensi.lupakatasand');
}


    public function kirimLinkReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

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
            'email' => 'required|email|exists:users,email',
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

        DB::table('users')->where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('status', 'Password berhasil diubah!');
    }

    // === ADMIN ===

    public function dashboardmin()
    {
        return $this->loadView('admin.dashboardmin');
    }

    public function ringkasanabsen()
    {
        return $this->loadView('admin.ringkasanabsen');
    }

    public function datapt()
    {
        return $this->loadView('admin.datapt');
    }

    public function pengguna()
    {
        return $this->loadView('admin.pengguna');
    }

    public function datapembimbing()
    {
        return $this->loadView('admin.datapembimbing');
    }

    public function managementakses()
    {
        return $this->loadView('admin.managementakses');
    }

    public function pengaturan()
    {
        return $this->loadView('admin.pengaturan');
    }

    public function notif()
    {
        return $this->loadView('admin.notif');
    }

    public function storeNotif(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        Notifikasi::create($request->only('name', 'email', 'message'));

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function showNotif()
    {
        $notifikasi = Notifikasi::orderBy('created_at', 'desc')->get();
        return view('admin.notif', compact('notifikasi'));
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::find($id);

        if (!$notifikasi) {
            return redirect()->back()->with('error', 'Notifikasi tidak ditemukan.');
        }

        $notifikasi->delete();
        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus!');
    }

    // === PERUSAHAAN ===

    public function dashboardpt()
    {
        return $this->loadView('perusahaan.dashboardpt');
    }

    public function pengaturanpt()
    {
        return $this->loadView('perusahaan.pengaturanpt');
    }

    public function nilai()
    {
        return $this->loadView('perusahaan.nilai');
    }

    public function profilpt()
    {
        return $this->loadView('perusahaan.profilpt');
    }

    public function ringkasanabsenpt()
    {
        return $this->loadView('perusahaan.ringkasanabsenpt');
    }

    public function pengajuanpt()
    {
        $pengajuan = Pengajuan::all();
        return view('perusahaan.pengajuanpt', compact('pengajuan'));
    }

    public function jadwalpt()
    {
        return $this->loadView('perusahaan.jadwalpt');
    }

    public function managementaksespt()
    {
        return $this->loadView('perusahaan.managementaksespt');
    }

    public function backupdatapt()
    {
        return $this->loadView('perusahaan.backupdatapt');
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
        return view()->exists($view) ? view($view) : $errorMsg;
    }
}
    