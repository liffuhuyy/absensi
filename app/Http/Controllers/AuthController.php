<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTugas;
use App\Models\Pengguna;
use App\Models\Absensi;
use App\Models\Biodata;
use App\Models\Notifikasi;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ================== UMUM ===================
    public function index() { return $this->loadView('absensi.index'); }
    public function showLoginForm() { return $this->loadView('absensi.login'); }
    public function showBerandaForm() { return $this->loadView('absensi.beranda'); }
    public function magang() { return $this->loadView('absensi.magang'); }
    public function editprofil() { return $this->loadView('absensi.editprofil'); }
    public function biodata() { return $this->loadView('absensi.biodata'); }
    public function izinsakit() { return $this->loadView('absensi.izinsakit'); }
    public function riwayatabsen() { return $this->loadView('absensi.riwayatabsen'); }
    public function presensi() { return $this->loadView('absensi.presensi'); }
    public function pengajuan1() { return $this->loadView('absensi.pengajuan'); }
    public function kontak() { return $this->loadView('absensi.kontak'); }
    public function resetkatasandi() { return $this->loadView('absensi.resetkatasandi'); }
    public function ubahkatasandiberhasil() { return $this->loadView('absensi.ubahkatasandiberhasil'); }
    public function lupakatasandi() { return $this->loadView('absensi.lupakatasandi'); }
    public function ubahkatasandi() { return $this->loadView('absensi.ubahkatasandi'); }
    public function tentangkami() { return $this->loadView('absensi.tentangkami'); }
    public function product() { return $this->loadView('absensi.product'); }

    public function profil()
    {
        $biodata = Biodata::whereNotNull('nohp')->get();
        return view('absensi.profil', compact('biodata'));
    }

    // ================== TUGAS ===================
    public function showTugas()
    {
        $tugas = UserTugas::all();
        return view('absensi.manajementugas', compact('tugas'));
    }

    public function manajementugas(Request $request)
    {
        return redirect()->route('manajementugas');
    }

    public function simpanTugas(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'tugas' => 'required|string',
        ]);

        try {
            UserTugas::create([
                'tanggal' => $request->tanggal,
                'tugas' => $request->tugas,
            ]);
            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function filter(Request $request)
    {
        $bulan = $request->bulan;
        $tugas = UserTugas::whereMonth('tanggal', $bulan)->get();
        return view('absensi.manajementugas', compact('tugas', 'bulan'));
    }

    // ================== ADMIN ===================
    public function dashboardmin() { return $this->loadView('admin.dashboardmin'); }
    public function ringkasanabsen() { return $this->loadView('admin.ringkasanabsen'); }
    public function datapt() { return $this->loadView('admin.datapt'); }
    public function pengguna() { return $this->loadView('admin.pengguna'); }
    public function managementakses() { return $this->loadView('admin.managementakses'); }
    public function notif() { return $this->loadView('admin.notif'); }
    public function pengaturan() { return $this->loadView('admin.pengaturan'); }

    public function storeNotif(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Notifikasi::create($request->only('nama', 'email', 'message'));

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

    // ================== PERUSAHAAN ===================
    public function dashboardpt() { return $this->loadView('perusahaan.dashboardpt'); }
    public function pengaturanpt() { return $this->loadView('perusahaan.pengaturanpt'); }
    public function nilai() { return $this->loadView('perusahaan.nilai'); }
    public function profilpt() { return $this->loadView('perusahaan.profilpt'); }
    public function ringkasanabsenpt() { return $this->loadView('perusahaan.ringkasanabsenpt'); }
    public function jadwalpt() { return $this->loadView('perusahaan.jadwalpt'); }
    public function managementaksespt() { return $this->loadView('perusahaan.managementaksespt'); }
    public function backupdatapt() { return $this->loadView('perusahaan.backupdatapt'); }

    public function managementpenggunapt()
    {
        return $this->loadView('perusahaan.managementpenggunapt');
    }

    public function pengajuanpt()
    {
        $pengajuan = Pengajuan::all();
        return view('perusahaan.pengajuanpt', compact('pengajuan'));
    }

    // ================== AUTH ===================
    public function register(Request $request)
    {
       $request->validate([
    'nama' => 'required|string|max:255',   // ubah dari 'name'
    'email' => 'required|email|unique:pengguna,email',
    'password' => 'required|min:6|confirmed',
]);

$user = Pengguna::create([
    'nama' => $request->nama,  // ubah dari 'name'
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role' => 'user',
]);

        Auth::login($user);

        return redirect()->route('beranda')->with('success', 'Pendaftaran berhasil! Anda telah login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('dashboardmin');
                case 'user':
                    return redirect()->route('beranda');
                case 'perusahaan':
                    return redirect()->route('dashboardpt');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['role' => 'Role tidak dikenali.']);
            }
        }

        return redirect()->route('login')->withErrors(['login' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // ================== HELPER ===================
    private function loadView(string $viewName)
    {
        return view()->exists($viewName)
            ? view($viewName)
            : abort(404, "View $viewName tidak ditemukan.");
    }
}
