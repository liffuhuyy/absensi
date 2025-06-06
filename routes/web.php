<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PenggunaController;
use App\Models\UserTugas;
use App\Models\Absensi;
use App\Models\Notifikasi;
use App\Models\Pengajuan;
use App\Models\Pengguna;

// Gunakan hanya Route::view untuk /absensi
Route::view('/absensi', 'absensi'); 

// Route resource untuk absensi (menggunakan resource standar)
Route::resource('absensi', absensiController::class);

// Route untuk halaman utama (index)
Route::get('/', function () {
    return view('absensi.index');
});

// Route untuk dashboard dengan middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

// Route untuk pengujian koneksi database
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Koneksi ke database berhasil!";
    } catch (\Exception $e) {
        return "Gagal terhubung: " . $e->getMessage();
    }
});

Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Route untuk halaman tambahan
Route::get('/index ', [AuthController::class, 'index'])->name('index');
Route::get('/product', [AuthController::class, 'product'])->name ('product');
Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('product.tentangkami');

//Bagian USER
Route::get('/index', [AuthController::class, 'index'])->name('index');
Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('absensi.tentangkami');
Route::get('/beranda', [AuthController::class, 'showBerandaForm'])->name('beranda');
Route::get('/presensi', [AuthController::class, 'presensi'])->name('presensi');
Route::get('/manajementugas', [AuthController::class, 'manajementugas'])->name('manajementugas');
Route::get('/pengajuan1', [AuthController::class, 'pengajuan1'])->name('pengajuan1');
Route::get('/kontak', [AuthController::class, 'kontak'])->name('kontak');
Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
Route::get('/editprofil', [AuthController::class, 'editprofil'])->name('editprofil');
Route::get('/biodata', [AuthController::class, 'biodata'])->name('biodata');
Route::get('/riwayatabsen', [AuthController::class, 'riwayatabsen'])->name('riwayatabsen');
Route::get('/izinsakit', [AuthController::class, 'izinsakit'])->name('izinsakit');
Route::get('/ubahkatasandi', [AuthController::class, 'ubahkatasandi'])->name('ubahkatasandi');
Route::get('/ubahkatasandiberhasil', [AuthController::class, 'ubahkatasandiberhasil'])->name('ubahkatasandiberhasil');
Route::post('/manajementugas', [AuthController::class, 'manajementugas'])->name('manajementugas');
Route::get('/filter', [AuthController::class, 'filter'])->name('filter');
Route::get('/manajementugas', [AuthController::class, 'showTugas']);
Route::post('/simpan-tugas', [AuthController::class, 'simpanTugas']);
Route::post('/absensi', [AbsensiController::class, 'store']);
Route::get('/absensi', [AbsensiController::class, 'absensi']);
Route::post('/absensi/izin', [AbsensiController::class, 'izin']);
Route::post('/absensi/simpan', [AbsensiController::class, 'simpan'])->name('simpan.absensi');
Route::post('/absensi/pulang-awal', [AbsensiController::class, 'pulangAwal']);
Route::get('/magang', [AuthController::class, 'magang'])->name('magang');
Route::post('/pengajuan', [PengajuanController::class, 'store']);
Route::get('/pengajuan', [PengajuanController::class, 'index']);
Route::post('/biodata/store', [BiodataController::class, 'store'])->name('biodata.store');
Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');
Route::put('/biodata/{id}', [BiodataController::class, 'update'])->name('biodata.update');

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