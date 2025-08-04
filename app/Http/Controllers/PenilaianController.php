<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
<<<<<<< HEAD
=======
use App\Models\Pengguna;
use App\Models\Biodata;
use App\Models\Pengajuan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
>>>>>>> 44734077802f2dac236b168425133a99aa31d034

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
<<<<<<< HEAD
        $penilaian = Penilaian::orderBy('created_at', 'desc')->get();

        if (!view()->exists('absensi.penilaian')) {
            abort(404, 'View absensi.penilaian tidak ditemukan.');
        }

        return view('absensi.penilaian', compact('penilaian'));
=======
        $pengguna = Auth::user();

        $penilaian = Penilaian::where('pengguna_id', $pengguna->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $biodata = Biodata::where('pengguna_id', $pengguna->id)->first();

        return view('absensi.penilaian', compact('penilaian', 'biodata'));
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    }

    /**
     * Simpan penilaian siswa
     */
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

<<<<<<< HEAD
=======
        // Redirect dengan pesan sukses
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
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
<<<<<<< HEAD
        $penilaian = Penilaian::all();

        if (!view()->exists('perusahaan.nilai')) {
            abort(404, 'View perusahaan.nilai tidak ditemukan.');
=======
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
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
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
