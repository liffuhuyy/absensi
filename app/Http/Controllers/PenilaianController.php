<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Pengguna;

class PenilaianController extends Controller
{
    public function penilaian()
    {
        $penilaian = Penilaian::orderBy('created_at', 'desc')->get();
        return view('absensi.penilaian', compact('penilaian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengguna_id' => 'required|integer',
            'nama' => 'required|string|max:255',
            'tanggal_keluar' => 'required|date'
        ]);

        Penilaian::create($validated);
        return redirect()->route('penilaian')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();
        return redirect()->route('penilaian')->with('success', 'Data berhasil dihapus.');
    }

    public function nilai()
    {
        if (view()->exists('perusahaan.nilai')) {
            $penilaian = Penilaian::all();
            return view('perusahaan.nilai', compact('penilaian'));
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nilai' => 'nullable|integer',
            'keterangan' => 'nullable|string|max:1000'
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $penilaian->update($validated);

        return redirect()->back()->with('success', 'Nilai siswa berhasil diperbarui.');
    }

    public function index()
    {
        $totalNilai = Penilaian::whereNotNull('nilai')->sum('nilai') ?? 0;
        return view('absensi.beranda', compact('totalNilai'));
    }
}
