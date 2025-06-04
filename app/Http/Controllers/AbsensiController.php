<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\JadwalKerja;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    // Cek apakah hari ini adalah hari kerja
    public function cekHariKerja()
    {
        $pengguna = Auth::user();
        $jadwal = JadwalKerja::where('pengguna_id', $pengguna->id)->first();

        if (!$jadwal || !$jadwal->isHariKerja()) {
            return view('libur', ['message' => 'Selamat berlibur! Hari ini bukan hari kerja']);
        }

        return view('absensi', ['jadwal' => $jadwal]);
    }

    // Absen masuk
    public function absenMasuk(Request $request)
    {
        $pengguna = Auth::user();
        $jadwal = JadwalKerja::where('pengguna_id', $pengguna->id)->first();
        $jamMasukResmi = Carbon::parse($jadwal->jam_masuk);
        $jamSekarang = Carbon::now();

        $status = ($jamSekarang->diffInMinutes($jamMasukResmi) > 5) ? 'Terlambat' : 'Hadir';

        Absensi::create([
            'pengguna_id' => $pengguna->id,
            'absen_masuk' => $jamSekarang,
            'lokasi_masuk' => $request->lokasi,
            'status' => $status
        ]);

        return response()->json(['message' => "Absen masuk berhasil. Status: $status"]);
    }

    // Absen pulang
    public function absenPulang(Request $request)
    {
        $pengguna = Auth::user();
        $jadwal = JadwalKerja::where('pengguna_id', $pengguna->id)->first();
        $jamPulangResmi = Carbon::parse($jadwal->jam_keluar);
        $jamSekarang = Carbon::now();

        $status = ($jamSekarang->greaterThan($jamPulangResmi->addHours(1))) ? 'Terlambat' : 'Hadir';

        Absensi::where('pengguna_id', $pengguna->id)->update([
            'absen_pulang' => $jamSekarang,
            'lokasi_pulang' => $request->lokasi,
            'status' => $status
        ]);

        return response()->json(['message' => "Absen pulang berhasil. Status: $status"]);
    }

    // Pulang lebih awal
    public function pulangAwal(Request $request)
    {
        $pengguna = Auth::user();
        $jadwal = JadwalKerja::where('pengguna_id', $pengguna->id)->first();
        $jamPulangResmi = Carbon::parse($jadwal->jam_keluar);
        $jamSekarang = Carbon::now();

        if ($jamSekarang->lessThan($jamPulangResmi)) {
            Absensi::where('pengguna_id', $pengguna->id)->update([
                'absen_pulang' => $jamSekarang,
                'lokasi_pulang' => $request->lokasi,
                'pulang_awal' => true,
                'alasan_pulang_cepat' => $request->alasan
            ]);

            return response()->json(['message' => "Pulang lebih awal berhasil dicatat"]);
        } else {
            return response()->json(['message' => "Sudah waktunya pulang, lakukan absen pulang biasa"]);
        }
    }

    public function riwayatAbsensi(Request $request)
{
    $pengguna = Auth::user();

    // Ambil bulan dan tahun yang dipilih, default ke bulan dan tahun saat ini
    $bulan = $request->input('bulan', Carbon::now()->format('m'));
    $tahun = $request->input('tahun', Carbon::now()->format('Y'));

    // Ambil data absensi sesuai bulan dan tahun
    $absensiData = Absensi::where('pengguna_id', $pengguna->id)
        ->whereMonth('absen_masuk', $bulan)
        ->whereYear('absen_masuk', $tahun)
        ->get();

    // Hitung statistik kehadiran
    $data = [
        'hadir' => $absensiData->where('status', 'Hadir')->count(),
        'terlambat' => $absensiData->where('status', 'Terlambat')->count(),
        'izin' => $absensiData->where('status', 'Izin')->count(),
        'sakit' => $absensiData->where('status', 'Sakit')->count(),
    ];

    return view('absensi.presensi', compact('absensiData', 'data', 'bulan', 'tahun'));
}
}