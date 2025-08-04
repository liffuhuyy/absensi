<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;

class PenilaianController extends Controller
{
    /**
     * Halaman beranda siswa setelah login
     */
    public function index()
    {
        $totalNilai = Penilaian::whereNotNull('nilai')->sum('nilai') ?? 0;

        if (!view()->exists('absensi.beranda')) {
            abort(404, 'View absensi.beranda tidak ditemukan.');
        }

        return view('absensi.beranda', compact('totalNilai'));
    }

    /**
     * Halaman penilaian siswa (akses siswa)
     */
    public function penilaian()
    {
        $penilaian = Penilaian::orderBy('created_at', 'desc')->get();

        if (!view()->exists('absensi.penilaian')) {
            abort(404, 'View absensi.penilaian tidak ditemukan.');
        }

        return view('absensi.penilaian', compact('penilaian'));
    }

    /**
     * Simpan penilaian siswa
     */
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

    /**
     * Hapus data penilaian
     */
    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('penilaian')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Halaman penilaian perusahaan
     */
    public function nilai()
    {
        $penilaian = Penilaian::all();

        if (!view()->exists('perusahaan.nilai')) {
            abort(404, 'View perusahaan.nilai tidak ditemukan.');
        }

        return view('perusahaan.nilai', compact('penilaian'));
    }

    /**
     * Update nilai & keterangan dari perusahaan
     */
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
