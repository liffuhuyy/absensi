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
    

        Pengajuan::create($request->all());

        return redirect('/pengajuan')->with('success', 'Pengajuan berhasil disimpan!');
    }

    public function index()
    {
        $pengajuan = Pengajuan::all();
        return view('absensi.magang', compact('pengajuan'));
    }
    

}