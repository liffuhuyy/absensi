<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PembimbingController;
use App\Models\Absensi;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

// Halaman Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

// Halaman utama (index)
Route::get('/', function () {
    return view('absensi.index');
});

// Tes koneksi database
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Koneksi ke database berhasil!";
    } catch (\Exception $e) {
        return "Gagal terhubung: " . $e->getMessage();
    }
});

/*
|--------------------------------------------------------------------------
| Dashboard (Multi-role)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboardmin', [AuthController::class, 'dashboardmin'])->name('dashboardmin');
    Route::get('/dashboardpt', [AuthController::class, 'dashboardpt'])->name('dashboardpt');
});

/*
|--------------------------------------------------------------------------
| Siswa Routes
|--------------------------------------------------------------------------
*/

//Bagian tampilan awal
Route::get('/index', [AuthController::class, 'index'])->name('index');
Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('tentangkami');
Route::get('/lupakatasandi', [AuthController::class, 'lupakatasandi'])->name('lupakatasandi');
Route::get('/resetkatasandi', [AuthController::class, 'resetkatasandi'])->name('resetkatasandi');

// Bagian USER
Route::middleware(['auth', RoleMiddleware::class.':user'])->group(function () {
    Route::get('/beranda', [AuthController::class, 'beranda'])->name('beranda');
});

Route::middleware('auth')->group(function () {
    Route::get('/beranda', [AuthController::class, 'showBerandaForm'])->name('beranda');
    Route::get('/index', [AuthController::class, 'index'])->name('index');
    Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('tentangkami');
    Route::get('/product', [AuthController::class, 'product'])->name('product');

    Route::get('/kontak', [AuthController::class, 'kontak'])->name('kontak');
    Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
    //sistem biodata
    Route::get('/editprofil', [AuthController::class, 'editprofil'])->name('editprofil');
    Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::post('/biodata/store', [BiodataController::class, 'store'])->name('biodata.store');
    Route::put('/biodata/{id}', [BiodataController::class, 'update'])->name('biodata.update');
    //sistem absensi
    Route::get('/presensi', [AuthController::class, 'presensi']);
    Route::get('/presensi', [AbsensiController::class, 'riwayatAbsensi'])->name('riwayat.absensi');

    Route::get('/riwayatabsen', [AuthController::class, 'riwayatabsen'])->name('riwayatabsen');
    Route::get('/izinsakit', [AuthController::class, 'izinsakit'])->name('izinsakit');
    Route::post('/absen/masuk', [AbsensiController::class, 'absenMasuk'])->name('absen.masuk');
    Route::post('/absen/pulang', [AbsensiController::class, 'absenPulang'])->name('absen.pulang');
    Route::post('/absen/pulang-awal', [AbsensiController::class, 'pulangAwal'])->name('absen.pulang-awal');
    Route::post('/izin', [AbsensiController::class, 'izin'])->name('absen.izin');
    Route::get('/cek-hari-kerja', [AbsensiController::class, 'cekHariKerja'])->name('cek.hari.kerja');
    //sistem ubah kata sandi
    Route::get('/ubahkatasandi', [AuthController::class, 'ubahkatasandi'])->name('ubahkatasandi');
    Route::get('/ubahkatasandiberhasil', [AuthController::class, 'ubahkatasandiberhasil'])->name('ubahkatasandiberhasil');
    //sistem manajemen tugas
    Route::post('/manajementugas', [AuthController::class, 'manajementugas'])->name('manajementugas');
    Route::get('/filter', [AuthController::class, 'filter'])->name('filter');
    Route::get('/manajementugas', [AuthController::class, 'showTugas']);
    Route::post('/simpan-tugas', [AuthController::class, 'simpanTugas']);
    Route::get('/filter', [AuthController::class, 'filter'])->name('filter');
    //sistem pengajuan magang
    Route::post('/pengajuan/tambah', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/tambah', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::get('/magang', [AuthController::class, 'showPengajuan1'])->name('pengajuan1');
    Route::get('/pengajuan1', [AuthController::class, 'pengajuan1'])->name('pengajuan1');
    Route::get('/pengajuan1', [PengajuanController::class, 'create']);

    Route::get('/manajementugas', [AuthController::class, 'showTugas'])->name('manajementugas');
    Route::post('/manajementugas', [AuthController::class, 'manajementugas']);
    Route::post('/simpan-tugas', [AuthController::class, 'simpanTugas']);
    Route::get('/filter', [AuthController::class, 'filter'])->name('filter');
    Route::get('/magang', [AuthController::class, 'magang'])->name('magang');

    // Pengajuan PKL
    Route::get('/pengajuan1', [AuthController::class, 'pengajuan1'])->name('pengajuan1');
    Route::get('/pengajuan', [PengajuanController::class, 'index']);
    Route::post('/pengajuan', [PengajuanController::class, 'store']);

    // Absensi
    Route::get('/absensi', [AbsensiController::class, 'absensi'])->name('absensi');
    Route::post('/absensi', [AbsensiController::class, 'store']);
    Route::post('/absensi/izin', [AbsensiController::class, 'izin']);
    Route::post('/absensi/simpan', [AbsensiController::class, 'simpan'])->name('simpan.absensi');
    Route::post('/absensi/pulang-awal', [AbsensiController::class, 'pulangAwal']);

    // PresensiController opsional (jika digunakan terpisah dari AbsensiController)
    Route::post('/presensi/store', [AbsensiController::class, 'store'])->name('presensi.store');
    Route::post('/izin', [AbsensiController::class, 'izin']);
    Route::post('/pulang-awal', [AbsensiController::class, 'pulangAwal']);
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/ringkasanabsen', [AuthController::class, 'ringkasanabsen'])->name('ringkasanabsen');
    Route::get('/datapt', [AuthController::class, 'datapt'])->name('datapt');
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/tambah', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::post('/pengguna/tambah', [PenggunaController::class, 'store']);
    Route::delete('/pengguna/hapus/{id}', [PenggunaController::class, 'hapus'])->name('pengguna.hapus');

    Route::get('/datapembimbing', [AuthController::class, 'datapembimbing'])->name('datapembimbing');
    Route::get('/managementakses', [AuthController::class, 'managementakses'])->name('managementakses');
    Route::get('/notif', [AuthController::class, 'showNotif'])->name('notif');
    Route::post('/admin/notif', [AuthController::class, 'storeNotif'])->name('admin.notif');
    Route::delete('/notifikasi/{id}', [AuthController::class, 'destroy'])->name('notifikasi.destroy');
    Route::get('/pengaturan', [AuthController::class, 'pengaturan'])->name('pengaturan');

    Route::get('/datapembimbing', [PembimbingController::class, 'index'])->name('datapembimbing');
    Route::post('/pembimbing/tambah', [PembimbingController::class, 'store'])->name('pembimbing.tambah');
    Route::put('/pembimbing/update/{id}', [PembimbingController::class, 'update'])->name('pembimbing.update');
    Route::delete('/pembimbing/hapus/{id}', [PembimbingController::class, 'destroy'])->name('pembimbing.hapus');
    });
/*
|--------------------------------------------------------------------------
| Perusahaan Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/pengaturanpt', [AuthController::class, 'pengaturanpt'])->name('pengaturanpt');
    Route::get('/nilai', [AuthController::class, 'nilai'])->name('nilai');
    Route::get('/ringkasanabsenpt', [AuthController::class, 'ringkasanabsenpt'])->name('ringkasanabsenpt');
    //sistem riwayat pengajuan magang perusahaan
    Route::get('/pengajuanpt', [AuthController::class, 'pengajuanpt'])->name('pengajuanpt');
    Route::post('/pengajuan/updateStatus', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
    
    Route::get('/managementaksespt', [AuthController::class, 'managementaksespt'])->name('managementaksespt');
    Route::get('/backupdatapt', [AuthController::class, 'backupdatapt'])->name('backupdatapt');
    //profil perusahaan
    Route::get('/profilpt', [AuthController::class, 'profilpt'])->name('profilpt');
    Route::get('/profilpt/create', [PerusahaanController::class, 'create'])->name('profilpt.create');
    Route::post('/profilpt/store', [PerusahaanController::class, 'store'])->name('profilpt.store');
    Route::get('/profilpt/edit/{profilpt}', [PerusahaanController::class, 'edit'])->name('profilpt.edit');
    Route::put('/profilpt/update/{profilpt}', [PerusahaanController::class, 'update'])->name('profilpt.update');
    //sistem jadwal kerja
    Route::get('/jadwalpt', [AuthController::class, 'jadwalpt'])->name('jadwalpt');
    Route::get('/jadwalpt', [JadwalKerjaController::class, 'index']);
    Route::get('/jadwal-perusahaan', [JadwalKerjaController::class, 'index'])->name('perusahaan.jadwalpt');
    Route::post('/jadwalpt/tambah', [JadwalKerjaController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwalpt/edit/{id}', [JadwalKerjaController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwalpt/update/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwalpt/hapus/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal.destroy');


// Route untuk halaman pengguna 
Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
Route::get('/pengguna/tambah', [PenggunaController::class, 'store'])->name('pengguna.store');
Route::post('/pengguna/tambah', [PenggunaController::class, 'store'])->name('pengguna.store');
Route::delete('/pengguna/hapus/{id}', [PenggunaController::class, 'hapus'])->name('pengguna.hapus');
Route::get('/admin/pengguna', [PenggunaController::class, 'index']);
Route::post('/login', [PenggunaController::class, 'login']);

// Rute untuk halaman login
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/absensi', [PresensiController::class, 'store']);
Route::post('/izin', [PresensiController::class, 'izin']);
Route::post('/pulang-awal', [PresensiController::class, 'pulangAwal']);
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
// Bagian ADMIN
Route::middleware(['auth', RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/dashboardmin', [AuthController::class, 'dashboardmin'])->name('dashboardmin');
});
    Route::get('/ringkasanabsen', [AuthController::class, 'ringkasanabsen'])->name('ringkasanabsen');
    Route::get('/datapt', [AuthController::class, 'datapt'])->name('datapt');
    Route::get('/pengguna', [AuthController::class, 'pengguna'])->name('pengguna');
    Route::get('/managementakses', [AuthController::class, 'managementakses'])->name('managementakses');
    Route::get('/notif', [AuthController::class, 'notif'])->name('notif');
    Route::post('/admin/notif', [AuthController::class, 'storeNotif'])->name('admin.notif');
    Route::get('/notif', [AuthController::class, 'showNotif'])->name('notif');
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::delete('/pengguna/hapus/{id}', [PenggunaController::class, 'hapus'])->name('pengguna.hapus');
    Route::post('/pengguna/tambah', [PenggunaController::class, 'store'])->name('pengguna.tambah');
    Route::delete('/notifikasi/{id}', [AuthController::class, 'destroy'])->name('notifikasi.destroy');
    Route::get('/pengaturan', [AuthController::class, 'pengaturan'])->name('pengaturan');
    Route::get('/cek-hari-kerja', [JadwalKerjaController::class, 'cekHariKerja'])->name('jadwal.cekHariKerja');
    Route::get('/cek-hari-kerja', [JadwalKerjaController::class, 'cekHariKerja'])->name('jadwal.cekHariKerja');
    Route::get('/jadwalpt', [AuthController::class, 'jadwalpt'])->name('jadwalpt');
    Route::get('/managementpenggunapt', [AuthController::class, 'managementpenggunapt'])->name('managementpenggunapt');
    Route::get('/managementaksespt', [AuthController::class, 'managementaksespt'])->name('managementaksespt');
    Route::get('/backupdatapt', [AuthController::class, 'backupdatapt'])->name('backupdatapt');
});

