<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Absensi;
use App\Models\Pengguna;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RingkasanAbsenController extends Controller
{
    public function filter(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $perusahaanId = Auth::user()->id;

        // Ambil siswa yang magang di perusahaan ini
        $siswaIds = \App\Models\Pengajuan::where('perusahaan_id', $perusahaanId)
            ->pluck('pengguna_id');

        // Query absensi siswa tersebut
        $query = \App\Models\Absensi::with('pengguna')
            ->whereIn('pengguna_id', $siswaIds);

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        $ringkasanabsenpt = $query->orderBy('tanggal', 'desc')->get();

        // Render partial view untuk dikembalikan ke AJAX
        $html = view('perusahaan.partials.absensi_body', compact('ringkasanabsenpt'))->render();

        return response()->json(['html' => $html]);
    }

    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $perusahaanId = Auth::user()->id; // ID perusahaan yang login

        // Ambil ID siswa yang magang di perusahaan ini dan status pengajuan 'diterima'
        $siswaIds = Pengajuan::where('perusahaan_id', $perusahaanId)
            ->where('status', 'diterima') // hanya siswa yang pengajuannya diterima
            ->pluck('pengguna_id');

        // Ambil absensi dari siswa-siswa tersebut
        $query = Absensi::with('pengguna')
            ->whereIn('pengguna_id', $siswaIds);

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        $ringkasanabsenpt = $query->orderBy('tanggal', 'desc')->get();

        return view('perusahaan.ringkasanabsenpt', compact('ringkasanabsenpt', 'bulan', 'tahun'));
    }





    //sistem riwayat absen admin
    public function riwayatAbsen(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = Absensi::with('pengguna');

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        $riwayat = $query->orderBy('tanggal', 'desc')->get();

        return view('admin.riwayat', compact('riwayat', 'bulan', 'tahun'));
    }
}
