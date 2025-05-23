<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTugas;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Biodata;
use App\Models\Notifikasi;
use App\Models\Pengajuan;

use Illuminate\Support\Facades\Auth;
 
class AuthController extends Controller
{
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

        $tugas = UserTugas::all(); 
        return response()->json($tugas);

    }

    public function showLoginForm()
    {
        if (view()->exists('absensi.login')) {
            return view('absensi.login');
        } else {
            return "View login tidak ditemukan.";
        }
    }

    public function magang()
    {
        if (view()->exists('absensi.magang')) {
            return view('absensi.magang');
        } else {
            return "View magang tidak ditemukan.";
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

    public function showTugas() {
        $tugas = UserTugas::all();
        return view('absensi.manajementugas', compact('tugas')); 
    }

    
    public function pengajuan1()
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
    $biodata = Biodata::whereNotNull('nohp')->get();
      return view('absensi.profil', compact('biodata'));
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
        $pengajuan = Pengajuan::all();
        return view('perusahaan.pengajuanpt', compact('pengajuan'));
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

    public function backupdatapt()
    {
        if (view()->exists('perusahaan.backupdatapt')) {
            return view('perusahaan.backupdatapt');
        } else {
            return "View tidak ditemukan.";
        }
    }



    //LOGIN DAN DAFTAR
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    
        Auth::login($user);
    
        return redirect('/beranda')->with('success', 'Pendaftaran berhasil! Anda telah login.');
    }

    public function login(Request $request) {

        dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
        }
    

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }
    
}
