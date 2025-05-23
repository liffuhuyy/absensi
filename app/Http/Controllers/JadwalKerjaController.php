<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\JadwalKerja;
use Illuminate\Support\Facades\Auth;


class JadwalKerjaController extends Controller
{
    // Simpan jadwal kerja
    public function store(Request $request)
    {
        $request->validate([
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i',
            'hari_kerja' => 'required|array'
        ]);

        $jadwal = JadwalKerja::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'jam_masuk' => $request->jam_masuk,
                'jam_keluar' => $request->jam_keluar,
                'hari_kerja' => $request->hari_kerja
            ]
        );

        return response()->json(['message' => 'Jadwal kerja berhasil disimpan!', 'data' => $jadwal]);
    }

    // Cek apakah hari ini adalah hari kerja
    public function cekHariKerja()
    {
        $jadwal = JadwalKerja::where('user_id', Auth::id())->first();

        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal kerja belum diatur!'], 400);
        }

        $hariIni = strtolower(now()->translatedFormat('l')); // Mendapatkan nama hari dalam bahasa Indonesia

        if (!in_array($hariIni, $jadwal->hari_kerja)) {
            return response()->json(['message' => 'Selamat berlibur! Hari ini tidak termasuk dalam jadwal kerja.'], 403);
        }

        return response()->json(['message' => 'Anda bisa melakukan absensi hari ini.']);
    }
}
