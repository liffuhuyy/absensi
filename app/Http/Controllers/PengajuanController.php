<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\JadwalKerjaController;
use App\Models\JadwalKerja;
use App\Models\Pengajuan;
use App\Models\Pengguna;
use App\Models\Biodata;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function store(Request $request)
    {
        $pengguna = Auth::user();

        if (!$pengguna) {
            return back()->withErrors(['error' => 'Pengguna tidak ditemukan']);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'nullable|date',
            'perusahaan_id' => 'required|exists:pengguna,id',
        ]);

        try {
            Pengajuan::create([
                'pengguna_id' => $pengguna->id,
                'nama' => $request->nama,
                'jurusan' => $request->jurusan,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_keluar' => $request->tanggal_keluar,
                'perusahaan_id' => $request->perusahaan_id,
                'status' => 'Menunggu',
            ]);

            return redirect('/magang')->with('success', 'Pengajuan berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function create()
    {
        $pengguna = Auth::user();
        $perusahaanList = JadwalKerja::select('pengguna_id')->distinct()->get();
        $biodata = Biodata::where('pengguna_id', $pengguna->id)->first();
        return view('absensi.pengajuan1', compact('perusahaanList', 'biodata'));
    }

    public function updateStatus(Request $request)
    {
        $pengajuan = Pengajuan::find($request->id);

        if ($pengajuan && $pengajuan->status == 'Menunggu') {
            $pengajuan->status = $request->status;
            $pengajuan->save();
            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui']);
        }

        return response()->json(['success' => false, 'message' => 'Status sudah diperbarui sebelumnya']);
    }

    public function pengajuan1()
    {
        if (view()->exists('absensi.pengajuan1')) {
            return view('absensi.pengajuan1');
        } else {
            return "View tidak ditemukan.";
        }
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

    public function nisn()
    {
        $pengguna = Auth::user();

        $nisn = Biodata::where('pengguna_id', $pengguna->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $biodata = Biodata::where('pengguna_id', $pengguna->id)->first();

        return view('perusahaan.pengajuanpt', compact('biodata'));
    }
}
