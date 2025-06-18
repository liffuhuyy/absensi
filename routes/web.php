<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RingkasanAbsenController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\JadwalKerjaController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\PembimbingController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('absensi.index'))->name('beranda');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', fn() => tap(Auth::logout(), fn() => redirect('/')));
Route::get('/get-jadwal-kerja', [AbsensiController::class, 'getJadwalDariPerusahaan']);
Route::get('/test-db', fn() => DB::connection()->getPdo() ? 'Koneksi ke database berhasil!' : 'Gagal koneksi.');

Route::view('/index', 'auth.index')->name('index');
Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('tentangkami');
Route::get('/lupakatasandi', [AuthController::class, 'lupakatasandi'])->name('lupakatasandi');
Route::get('/resetkatasandi', [AuthController::class, 'resetkatasandi'])->name('resetkatasandi');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':user'])->prefix('user')->group(function () {
    Route::get('/beranda', [AuthController::class, 'beranda'])->name('absensi.beranda');

    Route::get('/kontak', [NotifikasiController::class, 'kontak'])->name('user.kontak');
    Route::post('/notif', [NotifikasiController::class, 'storeNotif'])->name('user.notif');

    Route::get('/profil', [BiodataController::class, 'profil'])->name('user.profil');
    Route::get('/biodata', [BiodataController::class, 'index'])->name('user.biodata.index');
    Route::post('/biodata/store', [BiodataController::class, 'store'])->name('user.biodata.store');
    Route::put('/biodata/{id}', [BiodataController::class, 'update'])->name('user.biodata.update');
    Route::post('/upload-foto', [BiodataController::class, 'upload'])->name('user.foto.upload');

    Route::get('/presensi', [AbsensiController::class, 'presensi'])->name('user.presensi');
    Route::get('/riwayat-absensi', [AbsensiController::class, 'riwayatAbsensi'])->name('user.riwayat.absensi');
    Route::get('/riwayat-absensi/ajax', [AbsensiController::class, 'riwayatAbsensiAjax']);
    Route::get('/get-jadwal-kerja', [AbsensiController::class, 'getJadwalKerja']);
    Route::post('/absen/masuk', [AbsensiController::class, 'absenMasuk']);
    Route::post('/absen/pulang', [AbsensiController::class, 'absenPulang']);
    Route::post('/absen/pulang-awal', [AbsensiController::class, 'pulangAwal']);
    Route::post('/absen/izin', [AbsensiController::class, 'ajukanIzin']);
    Route::get('/absen-hari-ini', fn() => response()->json(\App\Models\Absensi::where('pengguna_id', Auth::id())->whereDate('tanggal', now()->toDateString())->first() ?? []));

    Route::post('/ubah-password', [PenggunaController::class, 'ubahPassword'])->name('user.ubah.password');

    Route::get('/penilaian', [PenilaianController::class, 'tampil'])->name('user.penilaian.index');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('user.penilaian.store');
    Route::delete('/penilaian/{id}', [PenilaianController::class, 'destroy'])->name('user.penilaian.destroy');

    Route::get('/tugas/filter', [TugasController::class, 'filter'])->name('user.tugas.filter');
    Route::get('/tugas', [TugasController::class, 'showTugas'])->name('user.tugas.index');
    Route::post('/tugas', [TugasController::class, 'simpanTugas'])->name('user.tugas.store');

    Route::get('/pengajuan', [PengajuanController::class, 'showPengajuan1'])->name('user.pengajuan.index');
    Route::get('/pengajuan/tambah', [PengajuanController::class, 'create'])->name('user.pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('user.pengajuan.store');
});

/*
|--------------------------------------------------------------------------
| Perusahaan Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':perusahaan'])->prefix('perusahaan')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboardpt'])->name('perusahaan.dashboard');

    Route::get('/absensi', [RingkasanAbsenController::class, 'ringkasanabsenpt'])->name('perusahaan.absensi');
    Route::get('/riwayat-absensi', [RingkasanAbsenController::class, 'riwayatAbsensi'])->name('perusahaan.riwayat.absensi');
    Route::get('/riwayat-absensi/ajax', [RingkasanAbsenController::class, 'riwayatAbsensiAjax']);

    Route::get('/penilaian', [PenilaianController::class, 'nilai'])->name('perusahaan.penilaian');
    Route::patch('/penilaian/{id}', [PenilaianController::class, 'update'])->name('perusahaan.penilaian.update');

    Route::get('/pengajuan', [PengajuanController::class, 'pengajuanpt'])->name('perusahaan.pengajuan');
    Route::post('/pengajuan/update-status', [PengajuanController::class, 'updateStatus'])->name('perusahaan.pengajuan.updateStatus');

    Route::resource('profil', PerusahaanController::class);
    Route::get('/profil', [PerusahaanController::class, 'profilpt'])->name('perusahaan.profil');

    Route::get('/jadwal', [JadwalKerjaController::class, 'index'])->name('perusahaan.jadwal.index');
    Route::post('/jadwal', [JadwalKerjaController::class, 'store'])->name('perusahaan.jadwal.store');
    Route::get('/jadwal/edit/{id}', [JadwalKerjaController::class, 'edit'])->name('perusahaan.jadwal.edit');
    Route::put('/jadwal/update/{id}', [JadwalKerjaController::class, 'update'])->name('perusahaan.jadwal.update');
    Route::delete('/jadwal/delete/{id}', [JadwalKerjaController::class, 'destroy'])->name('perusahaan.jadwal.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboardmin'])->name('admin.dashboard');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('admin.pengguna.index');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('admin.pengguna.store');
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'hapus'])->name('admin.pengguna.delete');

    Route::get('/notifikasi', [NotifikasiController::class, 'showNotif'])->name('admin.notifikasi.index');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('admin.notifikasi.destroy');

    Route::get('/jadwal/cek-hari-kerja', [JadwalKerjaController::class, 'cekHariKerja'])->name('admin.jadwal.cek');

    Route::get('/pembimbing', [PembimbingController::class, 'index'])->name('admin.pembimbing.index');
    Route::post('/pembimbing', [PembimbingController::class, 'store'])->name('admin.pembimbing.store');
    Route::put('/pembimbing/{id}', [PembimbingController::class, 'update'])->name('admin.pembimbing.update');
    Route::delete('/pembimbing/{id}', [PembimbingController::class, 'destroy'])->name('admin.pembimbing.destroy');
});
