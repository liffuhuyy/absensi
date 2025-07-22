<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Pengguna;
use App\Models\Biodata;
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

        $biodata = Biodata::where('pengguna_id', $pengguna->id)->first();

        return view('absensi.penilaian', compact('penilaian', 'biodata'));
    }

    public function store(Request $request)
    {
        // Validasi data dari form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|digits_between:8,12', // asumsi NISN 8-12 digit
            'tanggal_keluar' => 'required|date',
        ]);

        // Tambahkan ID pengguna yang sedang login
        $validated['pengguna_id'] = Auth::id();

        // Simpan ke database
        Penilaian::create($validated);

        // Redirect dengan pesan sukses
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
