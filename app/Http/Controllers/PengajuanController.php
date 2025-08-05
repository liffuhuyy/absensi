<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\JadwalKerja;
use App\Models\Pengajuan;
use App\Models\Pengguna;
use App\Models\Biodata;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function create()
    {
        $pengguna = Auth::user();
        $perusahaanList = JadwalKerja::select('pengguna_id')->distinct()->get();
        $biodata = Biodata::where('pengguna_id', $pengguna->id)->first();
        return view('absensi.pengajuan1', compact('perusahaanList', 'biodata'));
    }


    public function pengajuan1()
    {
        if (!view()->exists('absensi.pengajuan1')) {
            return "View tidak ditemukan.";
        }
        return view('absensi.pengajuan1');
    }


    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pengajuan,id',
            'status' => 'required|in:Disetujui,Ditolak'
        ]);

        $pengajuan = Pengajuan::find($request->id);

        if ($pengajuan->status == 'Menunggu') {
            $pengajuan->status = $request->status;
            $pengajuan->save();
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Status sudah diperbarui sebelumnya'
        ]);
    }


    //Menampilkan data di halaman pengajuan perusahaan
    public function pengajuanpt()
    {
        if (view()->exists('perusahaan.pengajuanpt')) {
            $perusahaanId = Auth::user()->id;

            // Ambil pengajuan yang ditujukan ke perusahaan ini
            $pengajuan = Pengajuan::with('pengguna') // pastikan relasi ke pengguna dimuat
                ->where('perusahaan_id', $perusahaanId)
                ->get();

            return view('perusahaan.pengajuanpt', compact('pengajuan'));
        } else {
            return "View tidak ditemukan.";
        }
    }



    //Menampilkan data di halaman magang
    public function showPengajuan1()
    {
        $pengajuan = Pengajuan::where('pengguna_id', Auth::id()) // hanya data milik user login
            ->paginate(10);

        return view('absensi.magang', compact('pengajuan'));
    }
}
