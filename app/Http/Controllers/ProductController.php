<?php

namespace App\Http\Controllers;

use App\Models\Absensi; // Pastikan nama model diawali huruf kapital
use Illuminate\Http\Request;
use Illuminate\View\View;

class AbsensiController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm(): View
    {
        return view('login');
    }

    /**
     * Tampilkan form registrasi
     */
    public function register(): View
    {
        return view('daftar');
    }

    /**
     * Tampilkan halaman beranda
     */
    public function beranda(): View
    {
        if (!view()->exists('absensi.beranda')) {
            abort(404, 'Halaman beranda tidak ditemukan.');
        }
        return view('absensi.beranda');
    }

    /**
     * Tampilkan halaman presensi
     */
    public function presensi(): View
    {
        return view('presensi');
    }

    /**
     * Tampilkan halaman manajemen tugas
     */
    public function manajementugas(): View
    {
        return view('manajementugas');
    }

    /**
     * Tampilkan halaman pengajuan
     */
    public function pengajuan(): View
    {
        return view('pengajuan');
    }

    /**
     * Tampilkan halaman kontak
     */
    public function kontak(): View
    {
        return view('kontak');
    }

    /**
     * Tampilkan halaman profil
     */
    public function profil(): View
    {
        return view('profil');
    }

    /**
     * Tampilkan halaman izin/sakit
     */
    public function izinsakit(): View
    {
        return view('izinsakit');
    }

    /**
     * Tampilkan halaman riwayat absen
     */ 
    public function riwayatabsen(): View
    {
        return view('riwayatabsen');
    }

    /**
     * Tampilkan halaman biodata
     */
    public function biodata(): View
    {
        return view('biodata');
    }

    /**
     * Tampilkan halaman edit profil
     */
    public function editprofil(): View
    {
        return view('absensi.editprofil');
    }

    /**
     * Tampilkan halaman index absensi
     */
    public function index(): View
    {
        return view('absensi.index');
    }

    /**
     * Tampilkan halaman tentang kami
     */
    public function tentangkami(): View
    {
        return view('tentangkami');
    }

    /**
     * Simpan data presensi
     */
    public function store(Request $request)
    {
        // Proses penyimpanan data presensi
        $presensi = new Absensi; // Pastikan menggunakan model yang benar
        $presensi->siswa_id = $request->siswa_id;
        $presensi->status = $request->status;
        $presensi->save();

        // Setelah menyimpan, kembali ke halaman sebelumnya
        return redirect()->back()->with('message', 'Data presensi berhasil disimpan');
    }
}
