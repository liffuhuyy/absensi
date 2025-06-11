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
    }

    public function filter(Request $request)
    {
        $request->validate(['bulan' => 'required|digits:2']);
        $bulan = $request->bulan;
        $tugas = UserTugas::whereMonth('tanggal', $bulan)->get();

        return $this->renderView('absensi.manajementugas', compact('tugas', 'bulan'));
    }

    public function simpanTugas(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'tugas' => 'required|string|max:255'
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
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        Notifikasi::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
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
}