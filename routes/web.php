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
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\TugasController;
<<<<<<< HEAD
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\PembimbingController;
=======
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\DashboardController;
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
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
<<<<<<< HEAD

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', fn() => tap(Auth::logout(), fn() => redirect('/')));

=======
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
//Bagian tampilan awal
Route::get('/index', [AuthController::class, 'index'])->name('index');
Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('tentangkami');

//Lupa kata sandi dan reset kata sandi
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
Route::get('/lupakatasandi', [AuthController::class, 'showFormEmail'])->name('lupakatasandi');
Route::post('/lupakatasandi', [AuthController::class, 'cekEmail'])->name('lupakatasandi.cek');

Route::get('/resetkatasandi', [AuthController::class, 'showFormReset'])->name('resetkatasandi');
Route::post('/resetkatasandi', [AuthController::class, 'prosesReset'])->name('resetkatasandi.proses');

<<<<<<< HEAD
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

=======

//kontak ALL
Route::post('/simpan', [NotifikasiController::class, 'kontakAll'])->name('simpan.kontak');
/*
|--------------------------------------------------------------------------
| User/siswa Routes
|--------------------------------------------------------------------------
*/
// Bagian USER
Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/beranda', [DashboardController::class, 'beranda'])->name('beranda');
    //sistem kontaK
    Route::post('/admin/notif', [NotifikasiController::class, 'storeNotif'])->name('admin.notif');
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    Route::get('/kontak', [NotifikasiController::class, 'kontak'])->name('kontak');
    Route::post('/admin/notif', [NotifikasiController::class, 'storeNotif'])->name('admin.notif');

    Route::get('/profil', [BiodataController::class, 'profil'])->name('profil');
    Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::post('/biodata/store', [BiodataController::class, 'store'])->name('biodata.store');
    Route::put('/biodata/{id}', [BiodataController::class, 'update'])->name('biodata.update');
    Route::post('/upload-foto', [BiodataController::class, 'upload'])->name('foto.upload');

    Route::get('/presensi', [AbsensiController::class, 'riwayatAbsensi'])->name('riwayat.absensi');
<<<<<<< HEAD
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
=======
    Route::get('/riwayat-absensi/ajax', [AbsensiController::class, 'riwayatAbsensiAjax']);
    Route::get('/get-jadwal-kerja', [AbsensiController::class, 'getJadwalKerja']);
    Route::post('/absen/masuk', [AbsensiController::class, 'absenMasuk']);
    Route::post('/absen/pulang', [AbsensiController::class, 'absenPulang']);
    Route::post('/absen/pulang-awal', [AbsensiController::class, 'pulangAwal']);
    Route::post('/absen/izin', [AbsensiController::class, 'absenIzin']);
    Route::get('/get-absen-hari-ini', function () {
        $user = Auth::user();
        $absen = \App\Models\Absensi::where('pengguna_id', $user->id)
            ->whereDate('tanggal', now()->toDateString())
            ->first();

        return response()->json($absen ?? []);
    });
    //sistem ubah kata sandi
    Route::post('/ubah-password', [PenggunaController::class, 'ubahPassword'])->name('ubah.password')->middleware('auth');
    //sisten penilaian
    Route::get('/penilaian', [PenilaianController::class, 'penilaian'])->name('penilaian');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::delete('/penilaian/{id}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');
    Route::get('/penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
    //sistem manajemen tugas
    Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('tugas.destroy');
    Route::get('/filter', [TugasController::class, 'filter'])->name('filter');
    Route::get('/manajementugas', [TugasController::class, 'showTugas'])->name('absensi.manajementugas');
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    Route::post('/simpan-tugas', [TugasController::class, 'simpanTugas']);

    Route::post('/pengajuan/tambah', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/tambah', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::get('/magang', [PengajuanController::class, 'showPengajuan1'])->name('pengajuan1');
<<<<<<< HEAD
    Route::get('/pengajuan1/create', [PengajuanController::class, 'create'])->name('pengajuan1.create');
=======
    Route::get('/pengajuan1', [PengajuanController::class, 'pengajuan1'])->name('pengajuan1');
    Route::get('/pengajuan1', [PengajuanController::class, 'create']);
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
});

Route::middleware(['auth', RoleMiddleware::class . ':perusahaan'])->group(function () {
<<<<<<< HEAD
    Route::get('/dashboardpt', [AuthController::class, 'dashboardpt'])->name('dashboardpt');
    Route::get('/ringkasanabsenpt', [AuthController::class, 'ringkasanabsenpt'])->name('ringkasanabsenpt');

=======
    Route::get('/dashboardpt', [DashboardController::class, 'perusahaan'])->name('dashboardpt');
    //sistem ringkasan absensi
    Route::get('/ringkasanabsenpt', [RingkasanAbsenController::class, 'index'])->name('ringkasanabsenpt.index');
    Route::get('/ringkasanabsenpt/filter', [RingkasanAbsenController::class, 'filter'])->name('ringkasanabsenpt.filter');
    //sistem penilaian
    Route::patch('/penilaian/{id}', [PenilaianController::class, 'update'])->name('penilaian.update');
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    Route::get('/nilai', [PenilaianController::class, 'nilai'])->name('nilai');
    Route::patch('/penilaian/{id}', [PenilaianController::class, 'update'])->name('penilaian.update');

    Route::get('/pengajuanpt', [PengajuanController::class, 'pengajuanpt'])->name('pengajuanpt');
    Route::post('/pengajuan/updateStatus', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
<<<<<<< HEAD

    Route::get('/profilpt', [PerusahaanController::class, 'profilpt'])->name('profilpt');
    Route::resource('perusahaan', PerusahaanController::class);

    Route::get('/jadwalpt', [JadwalKerjaController::class, 'index'])->name('jadwalpt');
=======
    //profil perusahaan
    Route::resource('perusahaan', PerusahaanController::class);
    Route::get('/profilpt', [PerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::post('/profilpt', [PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/pprofilpt/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
    Route::put('/profilpt/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');

    // Endpoint untuk AJAX
    Route::get('/perusahaan/json', [PerusahaanController::class, 'json']);
    Route::get('/perusahaan/{id}/data', [PerusahaanController::class, 'getData']);
    //sistem jadwal kerja
    Route::get('/jadwalpt', [JadwalKerjaController::class, 'jadwalpt'])->name('jadwalpt');
    Route::get('/jadwalpt', [JadwalKerjaController::class, 'index']);
    Route::get('/jadwal-perusahaan', [JadwalKerjaController::class, 'index'])->name('perusahaan.jadwalpt');
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    Route::post('/jadwalpt/tambah', [JadwalKerjaController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwalpt/edit/{id}', [JadwalKerjaController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwalpt/update/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwalpt/hapus/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal.destroy');
});
<<<<<<< HEAD

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboardmin', [AuthController::class, 'dashboardmin'])->name('dashboardmin');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
=======
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
// Bagian ADMIN
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboardmin', [DashboardController::class, 'admin'])->name('dashboardmin');
    //sistem akun pengguna
    Route::get('/pengguna', [PenggunaController::class, 'pengguna'])->name('pengguna');
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::delete('/pengguna/hapus/{id}', [PenggunaController::class, 'hapus'])->name('pengguna.hapus');
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    Route::post('/pengguna/tambah', [PenggunaController::class, 'store'])->name('pengguna.tambah');
    Route::delete('/pengguna/hapus/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.hapus');

    Route::get('/datapt', [AuthController::class, 'datapt'])->name('datapt');
    Route::get('/ringkasanabsen', [AuthController::class, 'ringkasanabsen'])->name('ringkasanabsen');

    Route::get('/notif', [NotifikasiController::class, 'notif'])->name('notif');
    Route::get('/notif', [NotifikasiController::class, 'showNotif'])->name('notif');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
<<<<<<< HEAD

    Route::get('/cek-hari-kerja', [JadwalKerjaController::class, 'cekHariKerja'])->name('jadwal.cekHariKerja');

=======
    //sistem riwayat absen
    Route::get('/riwayat', [RingkasanAbsenController::class, 'riwayatAbsen'])->name('riwayat.index');
    //sistem jadwal
    Route::get('/cek-hari-kerja', [JadwalKerjaController::class, 'cekHariKerja'])->name('jadwal.cekHariKerja');
    //sistem pembimbing
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    Route::get('/pembimbing', [PembimbingController::class, 'index'])->name('pembimbing.index');
    Route::post('/pembimbing/tambah', [PembimbingController::class, 'store'])->name('pembimbing.store');
    Route::put('/pembimbing/update/{id}', [PembimbingController::class, 'update'])->name('pembimbing.update');
    Route::delete('/pembimbing/hapus/{id}', [PembimbingController::class, 'destroy'])->name('pembimbing.destroy');
<<<<<<< HEAD
=======
});


// Tes koneksi database
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Koneksi ke database berhasil!";
    } catch (\Exception $e) {
        return "Gagal terhubung: " . $e->getMessage();
    }
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
});
