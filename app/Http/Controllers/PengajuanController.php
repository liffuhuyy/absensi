<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\JadwalKerjaController;
use App\Models\JadwalKerja;
use App\Models\Pengajuan;
use App\Models\Pengguna;
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
        $perusahaanList = JadwalKerja::select('pengguna_id')->distinct()->get();
        return view('absensi.pengajuan1', compact('perusahaanList'));
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::findOrFail($id); // Ambil data pengajuan berdasarkan ID
        return view('absensi.magang', compact('pengajuan')); // Tampilkan detail pengajuan
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

    public function create2()
    {
        $perusahaanList = JadwalKerja::select('pengguna_id')->distinct()->get();
        return view('absensi.magang', compact('perusahaanList'));
    }

    public function pengajuanpt()
    {
        if (view()->exists('perusahaan.pengajuanpt')) {
            $pengajuan = Pengajuan::all();
            return view('perusahaan.pengajuanpt', compact('pengajuan'));
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function showPengajuan1()
    {
        $pengajuan = Pengajuan::paginate(10);
        return view('absensi.magang', compact('pengajuan'));
    }

    public function pengajuan1()
    {
        if (view()->exists('absensi.pengajuan1')) {
            return view('absensi.pengajuan1');
        } else {
            return "View tidak ditemukan.";
        }
    }
}
