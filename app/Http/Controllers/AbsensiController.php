<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PengajuanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\JadwalKerja;
use App\Models\Pengajuan;

class AbsensiController extends Controller
{
    public function presensi()
    {
        if (view()->exists('absensi.presensi')) {
            return view('absensi.presensi');
        } else {
            return "View tidak ditemukan.";
        }
    }
    // Absen masuk
    public function absenMasuk(Request $request)
    {
        Log::info('Request absen masuk: ', $request->all());

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak terautentikasi'], 401);
        }

        // Setting timezone Jakarta (WIB)
        $waktuSekarang = now()->timezone('Asia/Jakarta');

        // Jadwal masuk dan pulang (format 24 jam)
        $jamMasuk = '07:30';
        $jamPulang = '16:00';

        // Buat objek Carbon untuk jadwal masuk dan pulang di hari ini
        $jadwalMasuk = Carbon::createFromFormat('Y-m-d H:i', $waktuSekarang->format('Y-m-d') . ' ' . $jamMasuk, 'Asia/Jakarta');
        $jadwalPulang = Carbon::createFromFormat('Y-m-d H:i', $waktuSekarang->format('Y-m-d') . ' ' . $jamPulang, 'Asia/Jakarta');

        // Tentukan status: terlambat jika absen lewat dari jam masuk
        $status = $waktuSekarang->greaterThan($jadwalMasuk) ? 'terlambat' : 'tepat waktu';

        // Cari atau buat record absensi hari ini untuk user
        $absensi = Absensi::firstOrNew([
            'pengguna_id' => $user->id,
            'tanggal' => $waktuSekarang->startOfDay(),  // tanggal hari ini WIB
        ]);

        if ($absensi->absen_masuk) {
            return response()->json(['error' => 'Sudah absen masuk hari ini'], 400);
        }

        // Simpan data absen masuk dengan waktu WIB tapi simpan di DB sesuai timezone server (biasanya UTC)
        $absensi->absen_masuk = $waktuSekarang->copy()->setTimezone('UTC'); // simpan UTC
        $absensi->lokasi_masuk_latitude = $request->latitude;
        $absensi->lokasi_masuk_longitude = $request->longitude;
        $absensi->status = $status;

        $absensi->save();
        Log::info('Absensi masuk berhasil', [
            'pengguna_id' => $user->id,
            'tanggal' => $waktuSekarang->toDateString(),
            'absen_masuk' => $absensi->absen_masuk->toDateTimeString(),
            'status' => $status,
            'lokasi_masuk_latitude' => $absensi->lokasi_masuk_latitude,
            'lokasi_masuk_longitude' => $absensi->lokasi_masuk_longitude,
        ]);
        return response()->json(['message' => 'Absen masuk berhasil'], 200);
    }

    public function absenPulang(Request $request)
    {
        Log::info('Request absen pulang: ', $request->all());

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak terautentikasi'], 401);
        }

        $absensi = Absensi::where('pengguna_id', $user->id)
            ->whereDate('tanggal', now()->timezone('Asia/Jakarta')->toDateString())
            ->first();

        if (!$absensi || !$absensi->absen_masuk) {
            return response()->json(['error' => 'Belum melakukan absen masuk'], 400);
        }

        if ($absensi->absen_pulang) {
            return response()->json(['error' => 'Sudah absen pulang hari ini'], 400);
        }

        // Waktu sekarang di WIB
        $waktuSekarang = now()->timezone('Asia/Jakarta');

        // Simpan waktu absen pulang dalam UTC ke DB
        $absensi->absen_pulang = $waktuSekarang->copy()->setTimezone('UTC');
        $absensi->lokasi_pulang_latitude = $request->latitude;
        $absensi->lokasi_pulang_longitude = $request->longitude;

        $absensi->save();

        return response()->json(['message' => 'Absen pulang berhasil'], 200);
    }


    public function pulangAwal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alasan_pulang_awal' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Harap isi semua data dengan benar!',
                'errors' => $validator->errors()
            ], 422);
        }
        // Cek apakah user sudah absen masuk hari ini
        $absensi = Absensi::where('pengguna_id', Auth::id())
            ->whereDate('tanggal', now()->toDateString())
            ->whereNull('absen_pulang') // Pastikan belum pulang
            ->first();

        if (!$absensi) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum melakukan absen masuk hari ini!'
            ], 404);
        }
        // Simpan data pulang awal
        $absensi->pulang_awal = true;
        $absensi->keterangan = $request->alasan_pulang_awal;
        $absensi->absen_pulang = now()->format('H:i:s');
        $absensi->lokasi_pulang_latitude = $request->latitude;
        $absensi->lokasi_pulang_longitude = $request->longitude;
        $absensi->save();

        return response()->json([
            'success' => true,
            'message' => 'Pulang awal berhasil dicatat!',
            'data' => $absensi
        ]);
    }

    public function ajukanIzin(Request $request)
    {
        Log::info('Request izin diterima:', $request->all());

        $request->validate([
            'status' => 'required|in:Izin,Sakit',
            'keterangan' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak terautentikasi'], 401);
        }

        $absensi = Absensi::firstOrNew([
            'pengguna_id' => $user->id,
            'tanggal' => Carbon::today(),
        ]);

        if (($absensi->absen_masuk || $absensi->absen_pulang)) {
            return response()->json(['error' => 'Tidak bisa izin setelah melakukan absen'], 400);
        }

        if (in_array($absensi->status, ['Izin', 'Sakit'])) {
            return response()->json(['error' => 'Sudah mengajukan izin hari ini'], 400);
        }

        $absensi->status = $request->status;
        $absensi->keterangan = $request->keterangan;
        $absensi->lokasi_masuk_latitude = $request->latitude;
        $absensi->lokasi_masuk_longitude = $request->longitude;

        $absensi->save();

        return response()->json(['message' => 'Izin berhasil diajukan'], 200);
    }

    // Riwayat Absensi
    public function riwayatAbsensi(Request $request)
    {
        $pengguna = Auth::user();

        if (!$pengguna) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        $bulan = (int) $request->input('bulan', Carbon::now()->format('m'));
        $tahun = (int) $request->input('tahun', Carbon::now()->format('Y'));

        $absensiData = Absensi::where('pengguna_id', $pengguna->id)
            ->whereMonth('absen_masuk', $bulan)
            ->whereYear('absen_masuk', $tahun)
            ->get();

        $statusList = ['Hadir', 'Terlambat', 'Izin', 'Sakit'];
        $data = [];

        foreach ($statusList as $status) {
            $data[strtolower($status)] = $absensiData->where('status', $status)->count();
        }

        return view('absensi.presensi', compact('absensiData', 'data', 'bulan', 'tahun'));
    }

    // Mendapatkan jadwal kerja dari perusahaan berdasarkan pengguna yang sedang login
    public function getJadwalDariPerusahaan()
    {
        $pengguna = Auth::user();

        if (!$pengguna) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        // Ambil pengajuan magang dari siswa saat ini
        $pengajuan = Pengajuan::where('pengguna_id', $pengguna->id)->first();

        if (!$pengajuan) {
            return response()->json(['error' => 'Pengajuan tidak ditemukan'], 404);
        }

        // Ambil jadwal kerja berdasarkan perusahaan_id dari pengajuan
        $jadwal = JadwalKerja::where('pengguna_id', $pengajuan->perusahaan_id)->first();

        if (!$jadwal) {
            return response()->json(['error' => 'Jadwal kerja tidak ditemukan untuk perusahaan ini'], 404);
        }

        return response()->json([
            'jam_masuk' => $jadwal->jam_masuk,
            'jam_keluar' => $jadwal->jam_keluar,
            'hari_kerja' => json_decode($jadwal->hari_kerja),
            'latitude' => $jadwal->latitude,
            'longitude' => $jadwal->longitude,
        ]);
    }
}
