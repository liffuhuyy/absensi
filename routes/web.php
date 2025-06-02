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

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('absensi.index'));
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
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
| Routes for Authenticated Users
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboardmin', [AuthController::class, 'dashboardmin'])->name('dashboardmin');
    Route::get('/dashboardpt', [AuthController::class, 'dashboardpt'])->name('dashboardpt');

    // Umum (Siswa)
    Route::get('/beranda', [AuthController::class, 'showBerandaForm'])->name('beranda');
    Route::get('/index', [AuthController::class, 'index'])->name('index');
    Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('tentangkami');
    Route::get('/product', [AuthController::class, 'product'])->name('product');
    Route::get('/kontak', [AuthController::class, 'kontak'])->name('kontak');
    Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
    Route::get('/editprofil', [AuthController::class, 'editprofil'])->name('editprofil');

    // Biodata
    Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::post('/biodata/store', [BiodataController::class, 'store'])->name('biodata.store');
    Route::put('/biodata/{id}', [BiodataController::class, 'update'])->name('biodata.update');

    // Fitur lain
    Route::get('/riwayatabsen', [AuthController::class, 'riwayatabsen'])->name('riwayatabsen');
    Route::get('/izinsakit', [AuthController::class, 'izinsakit'])->name('izinsakit');
    Route::get('/ubahkatasandi', [AuthController::class, 'ubahkatasandi'])->name('ubahkatasandi');
    Route::get('/ubahkatasandiberhasil', [AuthController::class, 'ubahkatasandiberhasil'])->name('ubahkatasandiberhasil');

    Route::get('/manajementugas', [AuthController::class, 'showTugas'])->name('manajementugas');
    Route::post('/manajementugas', [AuthController::class, 'manajementugas']);
    Route::post('/simpan-tugas', [AuthController::class, 'simpanTugas']);
    Route::get('/filter', [AuthController::class, 'filter'])->name('filter');
    Route::get('/magang', [AuthController::class, 'magang'])->name('magang');

    // Pengajuan PKL
    Route::get('/pengajuan1', [AuthController::class, 'pengajuan1'])->name('pengajuan1');
    Route::get('/pengajuan', [PengajuanController::class, 'index']);
    Route::post('/pengajuan', [PengajuanController::class, 'store']);

    // PERUSAHAAN
    Route::prefix('pt')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboardpt'])->name('dashboardpt');
        Route::get('/pengaturan', [AuthController::class, 'pengaturanpt'])->name('pengaturanpt');
        Route::get('/nilai', [AuthController::class, 'nilai'])->name('nilai');
        Route::get('/profil', [AuthController::class, 'profilpt'])->name('profilpt');
        Route::get('/ringkasanabsen', [AuthController::class, 'ringkasanabsenpt'])->name('ringkasanabsenpt');
        Route::get('/pengajuan', [AuthController::class, 'pengajuanpt'])->name('pengajuanpt');
        Route::post('/pengajuan/updateStatus', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
        Route::get('/jadwal', [AuthController::class, 'jadwalpt'])->name('jadwalpt');
        Route::get('/managementakses', [AuthController::class, 'managementaksespt'])->name('managementaksespt');
        Route::get('/backupdata', [AuthController::class, 'backupdatapt'])->name('backupdatapt');
        Route::get('/managementpengguna', [AuthController::class, 'managementpenggunapt'])->name('managementpenggunapt');
    });

    // Absensi
    Route::get('/absensi', [AbsensiController::class, 'absensi'])->name('absensi');
    Route::post('/absensi', [AbsensiController::class, 'store']);
    Route::post('/absensi/izin', [AbsensiController::class, 'izin']);
    Route::post('/absensi/simpan', [AbsensiController::class, 'simpan'])->name('simpan.absensi');
    Route::post('/absensi/pulang-awal', [AbsensiController::class, 'pulangAwal']);

    // Presensi opsional
    Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
    Route::post('/izin', [PresensiController::class, 'izin']);
    Route::post('/pulang-awal', [PresensiController::class, 'pulangAwal']);

    // ADMIN
    Route::get('/ringkasanabsen', [AuthController::class, 'ringkasanabsen'])->name('ringkasanabsen');
    Route::get('/datapt', [AuthController::class, 'datapt'])->name('datapt');
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/tambah', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::post('/pengguna/tambah', [PenggunaController::class, 'store']);
    Route::delete('/pengguna/hapus/{id}', [PenggunaController::class, 'hapus'])->name('pengguna.hapus');

    Route::get('/managementakses', [AuthController::class, 'managementakses'])->name('managementakses');
    Route::get('/notif', [AuthController::class, 'showNotif'])->name('notif');
    Route::post('/admin/notif', [AuthController::class, 'storeNotif'])->name('admin.notif');
    Route::delete('/notifikasi/{id}', [AuthController::class, 'destroy'])->name('notifikasi.destroy');
    Route::get('/pengaturan', [AuthController::class, 'pengaturan'])->name('pengaturan');
});
