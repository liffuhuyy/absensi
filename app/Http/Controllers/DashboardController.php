<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use App\Models\Pengguna;
use App\Models\Pengajuan;
use App\Models\JadwalKerja;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //ADMIN
    public function admin()
    {
        $sekarang = Carbon::now('Asia/Jakarta');
        $bulanIni = $sekarang->month;
        $tahunIni = $sekarang->year;

        // Total pengguna berdasarkan role
        $totalSiswa = Pengguna::where('role', 'user')->count();
        $totalPerusahaan = Pengguna::where('role', 'perusahaan')->count();

        // Jumlah status absensi bulan ini
        $jumlahHadir = Absensi::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('status', ['Hadir', 'Terlambat'])
            ->count();

        $jumlahTerlambat = Absensi::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'Terlambat')
            ->count();

        $jumlahIzin = Absensi::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'Izin')
            ->count();

        $jumlahSakit = Absensi::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->where('status', 'Sakit')
            ->count();

        // Grafik 6 bulan terakhir
        $dataGrafik = [];
        $bulanLabels = [];

        for ($i = 5; $i >= 0; $i--) {
            $bulan = $sekarang->copy()->subMonths($i);
            $bln = $bulan->month;
            $thn = $bulan->year;

            $bulanLabels[] = $bulan->format('M Y');

            $hadir = Absensi::whereMonth('tanggal', $bln)
                ->whereYear('tanggal', $thn)
                ->where('status', 'Hadir')
                ->count();

            $terlambat = Absensi::whereMonth('tanggal', $bln)
                ->whereYear('tanggal', $thn)
                ->where('status', 'Terlambat')
                ->count();

            $izin = Absensi::whereMonth('tanggal', $bln)
                ->whereYear('tanggal', $thn)
                ->where('status', 'Izin')
                ->count();

            $sakit = Absensi::whereMonth('tanggal', $bln)
                ->whereYear('tanggal', $thn)
                ->where('status', 'Sakit')
                ->count();

            $dataGrafik[] = [
                'hadir' => $hadir,
                'terlambat' => $terlambat,
                'izin' => $izin,
                'sakit' => $sakit,
            ];
        }

        // Kirim semua data ke view
        return view('admin.dashboardmin', compact(
            'totalSiswa',
            'totalPerusahaan',
            'jumlahHadir',
            'jumlahTerlambat',
            'jumlahIzin',
            'jumlahSakit',
            'dataGrafik',
            'bulanLabels'
        ));
    }

    //PERUSAHAAN
    public function perusahaan()
    {
        $sekarang = Carbon::now('Asia/Jakarta');
        $bulanIni = $sekarang->month;
        $tahunIni = $sekarang->year;

        $pengguna = Auth::user(); // Asumsikan login sebagai perusahaan
        $pengguna = Pengajuan::where('perusahaan_id', $pengguna->id)
            ->where('status', 'diterima') // pastikan status pengajuan diterima
            ->pluck('pengguna_id');

        // Total siswa magang di perusahaan ini
        $totalSiswa = $pengguna->count();

        // Absensi bulan ini hanya dari siswa yang magang di perusahaan tersebut
        $jumlahHadir = Absensi::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('pengguna_id', $pengguna)
            ->whereIn('status', ['Hadir', 'Terlambat'])
            ->count();

        $jumlahTerlambat = Absensi::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('pengguna_id', $pengguna)
            ->where('status', 'Terlambat')
            ->count();

        $jumlahIzin = Absensi::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('pengguna_id', $pengguna)
            ->where('status', 'Izin')
            ->count();

        $jumlahSakit = Absensi::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('pengguna_id', $pengguna)
            ->where('status', 'Sakit')
            ->count();

        // Grafik 6 bulan terakhir
        $dataGrafik = [];
        $bulanLabels = [];

        for ($i = 5; $i >= 0; $i--) {
            $bulan = $sekarang->copy()->subMonths($i);
            $label = $bulan->format('M Y');
            $bulanLabels[] = $label;

            $hadir = Absensi::whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)
                ->whereIn('pengguna_id', $pengguna)
                ->where('status', 'Hadir')
                ->count();

            $terlambat = Absensi::whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)
                ->whereIn('pengguna_id', $pengguna)
                ->where('status', 'Terlambat')
                ->count();

            $izin = Absensi::whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)
                ->whereIn('pengguna_id', $pengguna)
                ->where('status', 'Izin')
                ->count();

            $sakit = Absensi::whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)
                ->whereIn('pengguna_id', $pengguna)
                ->where('status', 'Sakit')
                ->count();

            $dataGrafik[] = [
                'hadir' => $hadir,
                'terlambat' => $terlambat,
                'izin' => $izin,
                'sakit' => $sakit,
            ];
        }

        return view('perusahaan.dashboardpt', compact(
            'totalSiswa',
            'jumlahHadir',
            'jumlahTerlambat',
            'jumlahIzin',
            'jumlahSakit',
            'dataGrafik',
            'bulanLabels'
        ));
    }


    //USER/SISWA
    public function beranda()
    {
        if (view()->exists('absensi.beranda')) {
            return view('absensi.beranda');
        } else {
            return "View tidak ditemukan.";
        }
    }
}
