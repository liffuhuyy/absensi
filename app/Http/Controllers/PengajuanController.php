<?php

namespace App\Http\Controllers;
use App\Http\Controllers\JadwalKerjaController;
use App\Models\JadwalKerja;
use App\Models\Pengajuan;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
public function store(Request $request)
{
    
    $request->validate([
        'nama' => 'required|string|max:255',
        'jurusan' => 'required|string|max:255',
        'tanggal_masuk' => 'required|date',
        'tanggal_keluar' => 'nullable|date',
        'perusahaan_id' => 'required|exists:pengguna,id', // Sesuaikan dengan nama tabel dan kolom di database
    ]);

    try {
        $pengajuan = Pengajuan::create([
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
            'perusahaan_id' => $request->perusahaan_id, // Sesuaikan dengan form input
            'status' => 'Menunggu', // Set nilai default
        ]);

        return redirect('/magang')->with('success', 'Pengajuan berhasil disimpan!');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
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
    return view('absensi.pengajuan1', compact('perusahaanList'));
}
}