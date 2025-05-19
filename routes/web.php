<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengajuanController;
use App\Models\UserTugas;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Pengajuan;

// Gunakan hanya Route::view untuk /absensi
Route::view('/absensi', 'absensi'); // Menampilkan view resources/views/absensi.blade.php

// Route resource untuk absensi (menggunakan resource standar)
Route::resource('absensi', absensiController::class);

// Route untuk halaman utama (index)
Route::get('/', function () {
    return view('absensi.index'); // Pastikan file index.blade.php ada di resources/views
});

// Route untuk dashboard dengan middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Pastikan file dashboard.blade.php ada
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
Route::post('/manajementugas', [AuthController::class, 'manajementugas'])->name('manajementugas');
Route::get('/manajementugas', [AuthController::class, 'showTugas']);
Route::post('/simpan-tugas', [AuthController::class, 'simpanTugas']);
Route::post('/absensi', [AuthController::class, 'store']);
Route::get('/absensi', [AuthController::class, 'absensi']);
Route::get('/magang', [AuthController::class, 'magang'])->name('magang');
Route::post('/pengajuan', [PengajuanController::class, 'store']);
Route::get('/pengajuan', [PengajuanController::class, 'index']);

//Bagian ADMIN
Route::get('/dashboardmin', [AuthController::class, 'dashboardmin'])->name('dashboardmin');
Route::get('/ringkasanabsen', [AuthController::class, 'ringkasanabsen'])->name('ringkasanabsen');
Route::get('/managementpengguna', [AuthController::class, 'managementpengguna'])->name('managementpengguna');
Route::get('/datasiswa', [AuthController::class, 'datasiswa'])->name('datasiswa');
Route::get('/managementakses', [AuthController::class, 'managementakses'])->name('managementakses');
Route::get('/notif', [AuthController::class, 'notif'])->name('notif');
Route::get('/pengaturan', [AuthController::class, 'pengaturan'])->name('pengaturan');

//Bagian PERUSAHAAN
Route::get('/dashboardpt', [AuthController::class, 'dashboardpt'])->name('dashboardpt');
Route::get('/pengaturanpt', [AuthController::class, 'pengaturanpt'])->name('pengaturanpt');
Route::get('/nilai', [AuthController::class, 'nilai'])->name('nilai');
Route::get('/profilpt', [AuthController::class, 'profilpt'])->name('profilpt');
Route::get('/ringkasanabsenpt', [AuthController::class, 'ringkasanabsenpt'])->name('ringkasanabsenpt');
Route::get('/pengajuanpt', [AuthController::class, 'pengajuanpt'])->name('pengajuanpt');
Route::get('/jadwalpt', [AuthController::class, 'jadwalpt'])->name('jadwalpt');
Route::get('/managementaksespt', [AuthController::class, 'managementaksespt'])->name('managementaksespt');
Route::get('/managementpenggunapt', [AuthController::class, 'managementpenggunapt'])->name('managementpenggunapt');
Route::get('/backupdatapt', [AuthController::class, 'backupdatapt'])->name('backupdatapt');

// Rute untuk halaman daftar dan login
Route::get('/daftar', [AuthController::class, 'showRegisterForm'])->name('register');
Route::get('/loginpt', [AuthController::class, 'loginpt'])->name('loginpt');
Route::get('/daftarpt', [AuthController::class, 'daftarpt'])->name('daftarpt');
Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/beranda', function() {
        return "Selamat datang di Dashboard!";
    })->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/absensi', [PresensiController::class, 'store']);
Route::post('/izin', [PresensiController::class, 'izin']);
Route::post('/pulang-awal', [PresensiController::class, 'pulangAwal']);