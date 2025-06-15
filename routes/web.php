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
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\TugasController;
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
Route::get('/get-jadwal-kerja', [AbsensiController::class, 'getJadwalDariPerusahaan']);
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

//Bagian tampilan awal
Route::get('/index', [AuthController::class, 'index'])->name('index');
Route::get('/tentangkami', [AuthController::class, 'tentangkami'])->name('tentangkami');
Route::get('/lupakatasandi', [AuthController::class, 'lupakatasandi'])->name('lupakatasandi');
Route::get('/resetkatasandi', [AuthController::class, 'resetkatasandi'])->name('resetkatasandi');
/*
|--------------------------------------------------------------------------
| User/siswa Routes
|--------------------------------------------------------------------------
*/
// Bagian USER
Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/beranda', [PenilaianController::class, 'index'])->name('beranda');
    //sistem konta
    Route::post('/admin/notif', [NotifikasiController::class, 'storeNotif'])->name('admin.notif');
    Route::get('/kontak', [NotifikasiController::class, 'kontak'])->name('kontak');
    //sistem biodata dan profil
    Route::post('/upload-foto', [BiodataController::class, 'upload'])->name('foto.upload');
    Route::get('/profil', [BiodataController::class, 'profil'])->name('profil');
    Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::post('/biodata/store', [BiodataController::class, 'store'])->name('biodata.store');
    Route::put('/biodata/{id}', [BiodataController::class, 'update'])->name('biodata.update');
    //sistem absensi
    Route::get('/presensi', [AbsensiController::class, 'presensi']);
    Route::get('/presensi', [AbsensiController::class, 'riwayatAbsensi'])->name('riwayat.absensi');
    Route::post('/absen/masuk', [AbsensiController::class, 'absenMasuk'])->name('absen.masuk');
    Route::post('/absen/pulang', [AbsensiController::class, 'absenPulang'])->name('absen.pulang');
    Route::post('/absen/izin', [AbsensiController::class, 'ajukanIzin'])->name('absen.izin');
    Route::post('/absen/pulang-awal', [AbsensiController::class, 'pulangAwal'])->name('absen.pulang.awal');
    Route::get('/cek-hari-kerja', [AbsensiController::class, 'cekHariKerja'])->name('cek.hari.kerja');
    Route::get('/cek-absensi', [AbsensiController::class, 'cekAbsensi']);
    //sistem ubah kata sandi
    Route::get('/ubahkatasandi', [AuthController::class, 'ubahkatasandi'])->name('ubahkatasandi');
    Route::get('/ubahkatasandiberhasil', [AuthController::class, 'ubahkatasandiberhasil'])->name('ubahkatasandiberhasil');
    //sisten penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::delete('/penilaian/{id}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');
    //sistem manajemen tugas
    Route::get('/filter', [TugasController::class, 'filter'])->name('filter');
    Route::get('/manajementugas', [TugasController::class, 'showTugas']);
    Route::post('/simpan-tugas', [TugasController::class, 'simpanTugas']);
    //sistem pengajuan magang
    Route::post('/pengajuan/tambah', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/tambah', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::get('/magang', [PengajuanController::class, 'showPengajuan1'])->name('pengajuan1');
    Route::get('/pengajuan1', [PengajuanController::class, 'pengajuan1'])->name('pengajuan1');
    Route::get('/pengajuan1', [PengajuanController::class, 'create']);
    //Sistem Penilaian
    Route::get('/penilaian', [PenilaianController::class, 'penilaian'])->name('penilaian');
});
/*
|--------------------------------------------------------------------------
| Perusahaan Routes
|--------------------------------------------------------------------------
*/
//Bagian PERUSAHAAN
Route::middleware(['auth', RoleMiddleware::class . ':perusahaan'])->group(function () {
    Route::get('/dashboardpt', [AuthController::class, 'dashboardpt'])->name('dashboardpt');
    Route::get('/ringkasanabsenpt', [AuthController::class, 'ringkasanabsenpt'])->name('ringkasanabsenpt');
    //sistem penilaian
    Route::patch('/penilaian/{id}', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::get('/nilai', [PenilaianController::class, 'nilai'])->name('nilai');
    //sistem riwayat pengajuan magang perusahaan
    Route::get('/pengajuanpt', [PengajuanController::class, 'pengajuanpt'])->name('pengajuanpt');
    Route::post('/pengajuan/updateStatus', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
    //profil perusahaan
    Route::resource('perusahaan', PerusahaanController::class);
    Route::get('/profilpt', [PerusahaanController::class, 'profilpt'])->name('profilpt');
    Route::get('/profilpt', [PerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::post('/perusahaan/store', [PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/perusahaan/{id}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
    Route::get('/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
    Route::put('/perusahaan/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
    Route::delete('/perusahaan/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
    //sistem jadwal kerja
    Route::get('/jadwalpt', [JadwalKerjaController::class, 'jadwalpt'])->name('jadwalpt');
    Route::get('/jadwalpt', [JadwalKerjaController::class, 'index']);
    Route::get('/jadwal-perusahaan', [JadwalKerjaController::class, 'index'])->name('perusahaan.jadwalpt');
    Route::post('/jadwalpt/tambah', [JadwalKerjaController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwalpt/edit/{id}', [JadwalKerjaController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwalpt/update/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwalpt/hapus/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal.destroy');
});
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
// Bagian ADMIN
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboardmin', [AuthController::class, 'dashboardmin'])->name('dashboardmin');
    //sistem akun pengguna
    Route::get('/pengguna', [PenggunaController::class, 'pengguna'])->name('pengguna');
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::delete('/pengguna/hapus/{id}', [PenggunaController::class, 'hapus'])->name('pengguna.hapus');
    Route::post('/pengguna/tambah', [PenggunaController::class, 'store'])->name('pengguna.tambah');
    //sistem nitofikasi
    Route::get('/notif', [NotifikasiController::class, 'notif'])->name('notif');
    Route::get('/notif', [NotifikasiController::class, 'showNotif'])->name('notif');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
    //sistem jadwal
    Route::get('/cek-hari-kerja', [JadwalKerjaController::class, 'cekHariKerja'])->name('jadwal.cekHariKerja');
});
