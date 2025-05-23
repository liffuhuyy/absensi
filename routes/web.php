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
use App\Http\Controllers\JadwalKerjaController;
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
Route::get('/dashboardmin', [AuthController::class, 'dashboardmin'])->name('dashboardmin');
Route::get('/dashboardpt', [AuthController::class, 'dashboardpt'])->name('dashboardpt');


/*
|--------------------------------------------------------------------------
| Siswa Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [AuthController::class, 'showBerandaForm'])->name('beranda');
    Route::get('/index', [AuthController::class, 'index'])->name('index');
    Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('tentangkami');
    Route::get('/kontak', [AuthController::class, 'kontak'])->name('kontak');
    Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
    Route::get('/editprofil', [AuthController::class, 'editprofil'])->name('editprofil');
    Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::post('/biodata/store', [BiodataController::class, 'store'])->name('biodata.store');
    Route::put('/biodata/{id}', [BiodataController::class, 'update'])->name('biodata.update');
    Route::get('/riwayatabsen', [AuthController::class, 'riwayatabsen'])->name('riwayatabsen');
    Route::get('/izinsakit', [AuthController::class, 'izinsakit'])->name('izinsakit');
    Route::get('/ubahkatasandi', [AuthController::class, 'ubahkatasandi'])->name('ubahkatasandi');
    Route::get('/ubahkatasandiberhasil', [AuthController::class, 'ubahkatasandiberhasil'])->name('ubahkatasandiberhasil');
    Route::get('/lupakatasandi', [AuthController::class, 'lupakatasandi'])->name('lupakatasandi');
    Route::get('/resetkatasandi', [AuthController::class, 'resetkatasandi'])->name('resetkatasandi');
    Route::post('/manajementugas', [AuthController::class, 'manajementugas'])->name('manajementugas');
    Route::get('/filter', [AuthController::class, 'filter'])->name('filter');
    Route::get('/manajementugas', [AuthController::class, 'showTugas']);
    Route::post('/simpan-tugas', [AuthController::class, 'simpanTugas']);
    Route::post('/absen/masuk', [AbsensiController::class, 'absenMasuk']);
    Route::post('/absen/keluar', [AbsensiController::class, 'absenKeluar']);
    Route::post('/izin', [AbsensiController::class, 'absenIzin']);
    Route::get('/absen/riwayat/{userId}', [AbsensiController::class, 'riwayatAbsensi']);
    Route::get('/magang', [AuthController::class, 'magang'])->name('magang');
    Route::post('/pengajuan', [PengajuanController::class, 'store']);
    Route::get('/pengajuan', [PengajuanController::class, 'index']);

//Bagian ADMIN
Route::get('/dashboardmin', [AuthController::class, 'dashboardmin'])->name('dashboardmin');
Route::get('/ringkasanabsen', [AuthController::class, 'ringkasanabsen'])->name('ringkasanabsen');
Route::get('/datapt', [AuthController::class, 'datapt'])->name('datapt');
Route::get('/pengguna', [AuthController::class, 'pengguna'])->name('pengguna');
Route::get('/managementakses', [AuthController::class, 'managementakses'])->name('managementakses');
Route::get('/notif', [AuthController::class, 'notif'])->name('notif');
Route::post('/admin/notif', [AuthController::class, 'storeNotif'])->name('admin.notif');
Route::get('/notif', [AuthController::class, 'showNotif'])->name('notif');
Route::delete('/notifikasi/{id}', [AuthController::class, 'destroy'])->name('notifikasi.destroy');
Route::get('/pengaturan', [AuthController::class, 'pengaturan'])->name('pengaturan');
Route::post('/jadwal-kerja', [JadwalKerjaController::class, 'store']); // Menyimpan jadwal kerja
Route::get('/cek-hari-kerja', [JadwalKerjaController::class, 'cekHariKerja']); // Cek apakah hari ini libur

//Bagian PERUSAHAAN
Route::get('/dashboardpt', [AuthController::class, 'dashboardpt'])->name('dashboardpt');
Route::get('/pengaturanpt', [AuthController::class, 'pengaturanpt'])->name('pengaturanpt');
Route::get('/nilai', [AuthController::class, 'nilai'])->name('nilai');
Route::get('/profilpt', [AuthController::class, 'profilpt'])->name('profilpt');
Route::get('/ringkasanabsenpt', [AuthController::class, 'ringkasanabsenpt'])->name('ringkasanabsenpt');
Route::get('/pengajuanpt', [AuthController::class, 'pengajuanpt'])->name('pengajuanpt');
Route::post('/pengajuan/updateStatus', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
Route::get('/jadwalpt', [AuthController::class, 'jadwalpt'])->name('jadwalpt');
Route::get('/managementaksespt', [AuthController::class, 'managementaksespt'])->name('managementaksespt');
Route::get('/backupdatapt', [AuthController::class, 'backupdatapt'])->name('backupdatapt');

// absensiController opsional (jika digunakan terpisah dari AbsensiController)
Route::post('/absensi', [AbsensiController::class, 'absenMasuk']);
Route::post('/izin', [AbsensiController::class, 'absenIzin']);
Route::post('/pulang-awal', [AbsensiController::class, 'pulangAwal']);
Route::get('/test', [AuthController::class, 'testMiddleware']);

}); // <--- Correctly closed