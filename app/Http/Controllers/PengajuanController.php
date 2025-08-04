<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\JadwalKerja;
use App\Models\Pengajuan;
<<<<<<< HEAD
=======
use App\Models\Pengguna;
use App\Models\Biodata;
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function create()
    {
        $pengguna = Auth::user();
        $perusahaanList = JadwalKerja::select('pengguna_id')->distinct()->get();
<<<<<<< HEAD
        return view('absensi.pengajuan1', compact('perusahaanList'));
    }

    public function create2()
    {
        $perusahaanList = JadwalKerja::select('pengguna_id')->distinct()->get();
        return view('absensi.magang', compact('perusahaanList'));
    }

    public function store(Request $request)
    {
        $pengguna = Auth::user();

        if (!$pengguna) {
            return back()->withErrors(['error' => 'Pengguna tidak ditemukan']);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'nullable|date|after_or_equal:tanggal_masuk',
            'perusahaan_id' => 'required|exists:pengguna,id',
        ]);

        try {
            Pengajuan::create([
                'pengguna_id' => $pengguna->id,
                'nama' => $validated['nama'],
                'jurusan' => $validated['jurusan'],
                'tanggal_masuk' => $validated['tanggal_masuk'],
                'tanggal_keluar' => $validated['tanggal_keluar'],
                'perusahaan_id' => $validated['perusahaan_id'],
                'status' => 'Menunggu',
            ]);

            return redirect('/magang')->with('success', 'Pengajuan berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan pengajuan: '.$e->getMessage()]);
        }
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('absensi.magang', compact('pengajuan'));
    }

    public function showPengajuan1()
    {
        $pengajuan = Pengajuan::paginate(10);
        return view('absensi.magang', compact('pengajuan'));
=======
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
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    }

    public function pengajuan1()
    {
        if (!view()->exists('absensi.pengajuan1')) {
            return "View tidak ditemukan.";
        }
        return view('absensi.pengajuan1');
    }

    public function pengajuanpt()
    {
        if (!view()->exists('perusahaan.pengajuanpt')) {
            return "View tidak ditemukan.";
        }
        $pengajuan = Pengajuan::all();
        return view('perusahaan.pengajuanpt', compact('pengajuan'));
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
