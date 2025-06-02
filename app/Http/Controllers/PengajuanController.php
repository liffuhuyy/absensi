<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string',
        'jurusan' => 'required|string',
        'tanggal_masuk' => 'required|date',
        'tanggal_keluar' => 'nullable|date',
        'perusahaan' => 'required|string',
    ]);
    Pengajuan::create([
        'nama' => $request->nama,
        'jurusan' => $request->jurusan,
        'tanggal_masuk' => $request->tanggal_masuk,
        'tanggal_keluar' => $request->tanggal_keluar,
        'perusahaan' => $request->perusahaan,
        'status' => 'Menunggu', // Set nilai default tanpa input dari user
    ]);

    return redirect('/magang')->with('success', 'Pengajuan berhasil disimpan!');
}

public function create()
{
    return view('absensi.magang'); // Tampilkan form pengajuan magang
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
}