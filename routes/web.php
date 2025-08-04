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
use App\Http\Controllers\JadwalKerjaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\TugasController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\PembimbingController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\UserTugas;
use App\Models\Absensi;
use App\Models\Biodata;
use App\Models\Notifikasi;
use App\Models\Pengajuan;
use App\Models\Pengguna;
use App\Models\JadwalKerja;
use App\Models\Penilaian;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', fn() => tap(Auth::logout(), fn() => redirect('/')));

Route::get('/lupakatasandi', [AuthController::class, 'showFormEmail'])->name('lupakatasandi');
Route::post('/lupakatasandi', [AuthController::class, 'cekEmail'])->name('lupakatasandi.cek');

Route::get('/resetkatasandi', [AuthController::class, 'showFormReset'])->name('resetkatasandi');
Route::post('/resetkatasandi', [AuthController::class, 'prosesReset'])->name('resetkatasandi.proses');

Route::get('/ubahkatasandiberhasil', fn() => view('ubahkatasandiberhasil'))->name('ubahkatasandiberhasil');

Route::get('/', fn() => view('absensi.index'));
Route::get('/index', [AuthController::class, 'index'])->name('index');
Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('tentangkami');

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Koneksi ke database berhasil!";
    } catch (\Exception $e) {
        return "Gagal terhubung: " . $e->getMessage();
    }
});

Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/beranda', [PenilaianController::class, 'index'])->name('beranda');

    Route::get('/kontak', [NotifikasiController::class, 'kontak'])->name('kontak');
    Route::post('/admin/notif', [NotifikasiController::class, 'storeNotif'])->name('admin.notif');

    Route::get('/profil', [BiodataController::class, 'profil'])->name('profil');
    Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::post('/biodata/store', [BiodataController::class, 'store'])->name('biodata.store');
    Route::put('/biodata/{id}', [BiodataController::class, 'update'])->name('biodata.update');
    Route::post('/upload-foto', [BiodataController::class, 'upload'])->name('foto.upload');

    Route::get('/presensi', [AbsensiController::class, 'riwayatAbsensi'])->name('riwayat.absensi');
    Route::post('/absen/masuk', [AbsensiController::class, 'absenMasuk'])->name('absen.masuk');
    Route::post('/absen/pulang', [AbsensiController::class, 'absenPulang'])->name('absen.pulang');
    Route::post('/absen/izin', [AbsensiController::class, 'ajukanIzin'])->name('absen.izin');
    Route::post('/absen/pulang-awal', [AbsensiController::class, 'pulangAwal'])->name('absen.pulang.awal');
    Route::get('/cek-hari-kerja', [AbsensiController::class, 'cekHariKerja'])->name('cek.hari.kerja');
    Route::get('/cek-absensi', [AbsensiController::class, 'cekAbsensi']);

    Route::get('/ubahkatasandiberhasil', fn() => view('absensi.ubahkatasandiberhasil'))->name('ubahkatasandiberhasil');

    Route::get('/penilaian', [PenilaianController::class, 'penilaian'])->name('penilaian');
    Route::post('/ubah-password', [PenggunaController::class, 'ubahPassword'])->name('ubah.password')->middleware('auth');
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::delete('/penilaian/{id}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');

    Route::get('/manajementugas', [TugasController::class, 'showTugas']);
    Route::get('/filter', [TugasController::class, 'filter'])->name('filter');
    Route::post('/simpan-tugas', [TugasController::class, 'simpanTugas']);

    Route::post('/pengajuan/tambah', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/tambah', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::get('/magang', [PengajuanController::class, 'showPengajuan1'])->name('pengajuan1');
    Route::get('/pengajuan1/create', [PengajuanController::class, 'create'])->name('pengajuan1.create');
});

Route::middleware(['auth', RoleMiddleware::class . ':perusahaan'])->group(function () {
    Route::get('/dashboardpt', [AuthController::class, 'dashboardpt'])->name('dashboardpt');
    Route::get('/ringkasanabsenpt', [AuthController::class, 'ringkasanabsenpt'])->name('ringkasanabsenpt');

    Route::get('/nilai', [PenilaianController::class, 'nilai'])->name('nilai');
    Route::patch('/penilaian/{id}', [PenilaianController::class, 'update'])->name('penilaian.update');

    Route::get('/pengajuanpt', [PengajuanController::class, 'pengajuanpt'])->name('pengajuanpt');
    Route::post('/pengajuan/updateStatus', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');

    Route::get('/profilpt', [PerusahaanController::class, 'profilpt'])->name('profilpt');
    Route::resource('perusahaan', PerusahaanController::class);

    Route::get('/jadwalpt', [JadwalKerjaController::class, 'index'])->name('jadwalpt');
    Route::post('/jadwalpt/tambah', [JadwalKerjaController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwalpt/edit/{id}', [JadwalKerjaController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwalpt/update/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwalpt/hapus/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal.destroy');
});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboardmin', [AuthController::class, 'dashboardmin'])->name('dashboardmin');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::post('/pengguna/tambah', [PenggunaController::class, 'store'])->name('pengguna.tambah');
    Route::delete('/pengguna/hapus/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.hapus');

    Route::get('/datapt', [AuthController::class, 'datapt'])->name('datapt');
    Route::get('/ringkasanabsen', [AuthController::class, 'ringkasanabsen'])->name('ringkasanabsen');

    Route::get('/notif', [NotifikasiController::class, 'notif'])->name('notif');
    Route::get('/notif', [NotifikasiController::class, 'showNotif'])->name('notif');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');

    Route::get('/cek-hari-kerja', [JadwalKerjaController::class, 'cekHariKerja'])->name('jadwal.cekHariKerja');

    Route::get('/pembimbing', [PembimbingController::class, 'index'])->name('pembimbing.index');
    Route::post('/pembimbing/tambah', [PembimbingController::class, 'store'])->name('pembimbing.store');
    Route::put('/pembimbing/update/{id}', [PembimbingController::class, 'update'])->name('pembimbing.update');
    Route::delete('/pembimbing/hapus/{id}', [PembimbingController::class, 'destroy'])->name('pembimbing.destroy');
});
