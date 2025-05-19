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
            'status' => 'Menunggu',
        ]);
    

        Pengajuan::create($request->all());

        return redirect('/pengajuan')->with('success', 'Pengajuan berhasil disimpan!');
    }

    public function index()
    {
        $pengajuan = Pengajuan::all();
        return view('absensi.magang', compact('pengajuan'));
    }
    
   public function updateStatus(Request $request)
{
    $pengajuan = Pengajuan::find($request->id);

    if ($pengajuan && $pengajuan->status == 'Menunggu') { // Hanya bisa diubah jika status masih "Menunggu"
        $pengajuan->status = $request->status;
        $pengajuan->save();
        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui']);
    }

    return response()->json(['success' => false, 'message' => 'Status sudah diperbarui sebelumnya']);
}


}