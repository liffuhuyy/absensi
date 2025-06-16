<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\JadwalKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalKerjaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i|after:jam_masuk',
            'hari_kerja' => 'required|array',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        JadwalKerja::create([
            'pengguna_id' => Auth::id(), // Ganti user_id dengan pengguna_id
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'hari_kerja' => json_encode($request->hari_kerja),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('perusahaan.jadwalpt')->with('success', 'Jadwal kerja berhasil ditambahkan');
    }

    public function index()
    {
        $jadwal = JadwalKerja::where('pengguna_id', Auth::id())->first();
        return view('perusahaan.jadwalpt', compact('jadwal')); // Pastikan variabel dikirim
    }

    public function edit($id)
    {
        try {
            // Cari jadwal berdasarkan ID yang diberikan
            $jadwal = JadwalKerja::where('pengguna_id', Auth::id())->where('id', $id)->first();

            // Pastikan jadwal ditemukan
            if (!$jadwal) {
                return response()->json(['error' => 'Data tidak ditemukan'], 404);
            }

            return response()->json([
                'id' => $jadwal->id,
                'jam_masuk' => $jadwal->jam_masuk,
                'jam_keluar' => $jadwal->jam_keluar,
                'latitude' => isset($jadwal->latitude) ? $jadwal->latitude : 'Tidak Ada',
                'longitude' => isset($jadwal->longitude) ? $jadwal->longitude : 'Tidak Ada',
                'hari_kerja' => json_decode($jadwal->hari_kerja, true) ?: [],
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal memuat data jadwal: ' . $e->getMessage());

            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk',
            'hari_kerja' => 'nullable|array',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Cari jadwal berdasarkan ID
        $jadwal = JadwalKerja::findOrFail($id);

        // Update data dengan nilai yang tersedia
        $jadwal->update([
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar ?? $jadwal->jam_keluar,
            'hari_kerja' => $request->filled('hari_kerja') ? json_encode($request->hari_kerja) : $jadwal->hari_kerja,
            'latitude' => $request->filled('latitude') ? $request->latitude : $jadwal->latitude,
            'longitude' => $request->filled('longitude') ? $request->longitude : $jadwal->longitude,
        ]);

        // Jika request berasal dari AJAX, kembalikan respons JSON
        if ($request->ajax()) {
            return response()->json(['message' => 'Jadwal kerja berhasil diperbarui!', 'data' => $jadwal]);
        }

        // Jika bukan AJAX, redirect dengan pesan sukses
        return redirect()->route('perusahaan.jadwalpt')->with('success', 'Jadwal kerja berhasil diperbarui');
    }


    public function destroy($id)
    {
        $jadwal = JadwalKerja::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('perusahaan.jadwalpt')->with('success', 'Jadwal kerja berhasil dihapus');
    }

    public function create()
    {
        $perusahaanList = JadwalKerja::select('pengguna_id')->distinct()->get();
        return view('absensi.pengajuan1', compact('perusahaanList'));
    }

    public function jadwalpt()
    {
        if (view()->exists('perusahaan.jadwalpt')) {
            return view('perusahaan.jadwalpt');
        } else {
            return "View tidak ditemukan.";
        }
    }
}
