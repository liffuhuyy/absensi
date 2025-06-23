<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Pengguna;
use App\Models\Pengajuan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function penilaian()
    {
        $pengguna = Auth::user();
        $penilaian = Penilaian::where('pengguna_id', $pengguna->id)
            ->orderBy('created_at', 'desc')
            ->get();

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
            $perusahaanId = Auth::user()->id;

            // Ambil pengguna (siswa) yang magang di perusahaan ini dan sudah diterima
            $pengguna = Pengajuan::where('perusahaan_id', $perusahaanId)
                ->where('status', 'diterima')
                ->pluck('pengguna_id');

            // Ambil data penilaian untuk siswa tersebut
            $penilaian = Penilaian::with('pengguna') // pastikan relasi pengguna ada di model Penilaian
                ->whereIn('pengguna_id', $pengguna)
                ->get();

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
}
