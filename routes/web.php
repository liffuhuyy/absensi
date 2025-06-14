<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PenggunaController;

use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PembimbingController;
use App\Models\Absensi;
use App\Http\Controllers\JadwalKerjaController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\UserTugas;
use App\Models\Absensi;
use App\Models\Notifikasi;
use App\Models\Pengajuan;
use App\Models\Pengguna;
use App\Models\JadwalKerja;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

// Halaman Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// **Logout harus POST, tidak boleh GET**
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
    Route::post('/reset/proses', [AuthController::class, 'prosesReset'])->name('reset.proses');
    Route::get('/dashboardmin', [AuthController::class, 'dashboardmin'])->name('dashboardmin');
    Route::get('/dashboardpt', [AuthController::class, 'dashboardpt'])->name('dashboardpt');
});

/*
|--------------------------------------------------------------------------
| Siswa Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/beranda', [AuthController::class, 'beranda']);
    Route::get('/index', [AuthController::class, 'index'])->name('index');
    Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('tentangkami');
    Route::get('/product', [AuthController::class, 'product'])->name('product');
    Route::get('/kontak', [AuthController::class, 'kontak'])->name('kontak');
    Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
    Route::get('/editprofil', [AuthController::class, 'editprofil'])->name('editprofil');
    Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::post('/biodata/store', [BiodataController::class, 'store'])->name('biodata.store');
    Route::put('/biodata/{id}', [BiodataController::class, 'update'])->name('biodata.update');

    Route::get('/riwayatabsen', [AuthController::class, 'riwayatabsen'])->name('riwayatabsen');
    Route::get('/izinsakit', [AuthController::class, 'izinsakit'])->name('izinsakit');
    //sistem absensi
    Route::get('/presensi', [AuthController::class, 'presensi']);
    Route::get('/presensi', [AbsensiController::class, 'riwayatAbsensi'])->name('riwayat.absensi');
    Route::post('/absen/masuk', [AbsensiController::class, 'absenMasuk'])->name('absen.masuk');
    Route::post('/absen/pulang', [AbsensiController::class, 'absenPulang'])->name('absen.pulang');
    Route::post('/absen/izin', [AbsensiController::class, 'ajukanIzin'])->name('absen.izin');
    Route::post('/absen/pulang-awal', [AbsensiController::class, 'pulangAwal'])->name('absen.pulang.awal');
    Route::get('/cek-hari-kerja', [AbsensiController::class, 'cekHariKerja'])->name('cek.hari.kerja');
    Route::get('/get-jadwal-kerja', [AbsensiController::class, 'getJadwalDariPerusahaan']);
    Route::get('/cek-absensi', [AbsensiController::class, 'cekAbsensi']);
    //sistem ubah kata sandi

    Route::get('/ubahkatasandi', [AuthController::class, 'ubahkatasandi'])->name('ubahkatasandi');
    Route::get('/ubahkatasandiberhasil', [AuthController::class, 'ubahkatasandiberhasil'])->name('ubahkatasandiberhasil');
    Route::get('/lupakatasandi', [AuthController::class, 'lupakatasandi'])->name('lupakatasandi');
    Route::get('/resetkatasandi', [AuthController::class, 'resetkatasandi'])->name('resetkatasandi');
    Route::post('/resetkatasandi', [AuthController::class, 'updatePassword'])->name('resetkatasandi.update');

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
    Route::get('/pengaturanpt', [AuthController::class, 'pengaturanpt'])->name('pengaturanpt');
    Route::get('/nilai', [AuthController::class, 'nilai'])->name('nilai');
    Route::get('/ringkasanabsenpt', [AuthController::class, 'ringkasanabsenpt'])->name('ringkasanabsenpt');
    //sistem riwayat pengajuan magang perusahaan
    Route::get('/pengajuanpt', [AuthController::class, 'pengajuanpt'])->name('pengajuanpt');
    Route::post('/pengajuan/updateStatus', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
    
    Route::get('/managementaksespt', [AuthController::class, 'managementaksespt'])->name('managementaksespt');
    Route::get('/backupdatapt', [AuthController::class, 'backupdatapt'])->name('backupdatapt');
    //profil perusahaan
    Route::resource('perusahaan', PerusahaanController::class);
    Route::get('/profilpt', [AuthController::class, 'profilpt'])->name('profilpt');
    Route::get('/profilpt', [PerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::post('/perusahaan/store', [PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/perusahaan/{id}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
    Route::get('/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
    Route::put('/perusahaan/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
    Route::delete('/perusahaan/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
    //sistem jadwal kerja
    Route::get('/jadwalpt', [AuthController::class, 'jadwalpt'])->name('jadwalpt');
    Route::get('/jadwalpt', [JadwalKerjaController::class, 'index']);
    Route::get('/jadwal-perusahaan', [JadwalKerjaController::class, 'index'])->name('perusahaan.jadwalpt');
    Route::post('/jadwalpt/tambah', [JadwalKerjaController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwalpt/edit/{id}', [JadwalKerjaController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwalpt/update/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwalpt/hapus/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal.destroy');
>>>>>>> 67f9bbe9181646bf2bcc270fd7c2d2d83b1e4285
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
    Route::get('/profilpt', [AuthController::class, 'profilpt'])->name('profilpt');
    Route::get('/ringkasanabsenpt', [AuthController::class, 'ringkasanabsenpt'])->name('ringkasanabsenpt');
    Route::get('/pengajuanpt', [AuthController::class, 'pengajuanpt'])->name('pengajuanpt');
    Route::post('/pengajuan/updateStatus', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
    Route::get('/jadwalpt', [AuthController::class, 'jadwalpt'])->name('jadwalpt');
    Route::get('/managementpenggunapt', [AuthController::class, 'managementpenggunapt'])->name('managementpenggunapt');
    Route::get('/managementaksespt', [AuthController::class, 'managementaksespt'])->name('managementaksespt');
    Route::get('/backupdatapt', [AuthController::class, 'backupdatapt'])->name('backupdatapt');
});
