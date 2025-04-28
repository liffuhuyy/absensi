<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absensiController;
use App\Http\Controllers\AuthController;

// Gunakan hanya Route::view untuk /absensi
Route::view('/absensi', 'absensi'); // Menampilkan view resources/views/absensi.blade.php

// Route resource untuk absensi (menggunakan resource standar)
Route::resource('absensi', ProductController::class);

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

// Route untuk halaman tambahan
Route::get('/index ', [AuthController::class, 'index'])->name('index');
Route::get('/product', [AuthController::class, 'product'])->name ('product');
Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('product.tentangkami');
Route::get('/beranda', [AuthController::class, 'showBerandaForm'])->name('beranda');
Route::get('/presensi', [AuthController::class, 'presensi'])->name('presensi');
Route::get('/manajementugas', [AuthController::class, 'manajementugas'])->name('manajementugas');
Route::get('/pengajuan', [AuthController::class, 'pengajuan'])->name('pengajuan');
Route::get('/kontak', [AuthController::class, 'kontak'])->name('kontak');
Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
Route::get('/editprofil', [AuthController::class, 'editprofil'])->name('editprofil');
Route::get('/biodata', [AuthController::class, 'biodata'])->name('biodata');
Route::get('/riwayatabsen', [AuthController::class, 'riwayatabsen'])->name('riwayatabsen');
Route::get('/izinsakit', [AuthController::class, 'izinsakit'])->name('izinsakit');

// Rute untuk halaman daftar
Route::get('/daftar', [AuthController::class, 'showRegisterForm'])->name('register');

// Routes untuk autentikasi
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login'); // Pastikan metode login ada di AuthController
});
