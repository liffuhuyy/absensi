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

        // Buat objek Carbon untuk jadwal masuk di hari ini
        $jadwalMasuk = Carbon::createFromFormat('Y-m-d H:i', $waktuSekarang->format('Y-m-d') . ' ' . $jamMasuk, 'Asia/Jakarta');

        // Tentukan status: terlambat jika absen lewat dari jam masuk
        $status = $waktuSekarang->greaterThan($jadwalMasuk) ? 'terlambat' : 'tepat waktu';

        // Cari atau buat record absensi hari ini untuk user
        $absensi = Absensi::firstOrNew([
            'pengguna_id' => $user->id,
            'tanggal' => $waktuSekarang->toDateString(), // Simpan sebagai tanggal saja (tanpa jam)
        ]);

        if ($absensi->absen_masuk) {
            return response()->json(['error' => 'Sudah absen masuk hari ini'], 400);
        }

        // Simpan data absen masuk dengan waktu WIB
        $absensi->absen_masuk = $waktuSekarang;
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


    // Absen pulang
    public function absenPulang(Request $request)
    {
        $pengguna = Auth::user();
        $hariIni = strtolower(now()->locale('id')->translatedFormat('l')); // misalnya: 'selasa'

        if (!$pengguna) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        // Cek pengajuan aktif
        $pengajuan = Pengajuan::where('pengguna_id', $pengguna->id)
            ->where('status', 'diterima')
            ->first();

        if (!$pengajuan) {
            return response()->json(['error' => 'Pengajuan belum disetujui.'], 403);
        }

        // Cek jadwal kerja perusahaan
        $jadwalKerja = JadwalKerja::where('pengguna_id', $pengajuan->perusahaan_id)->first();

        if (!$jadwalKerja) {
            return response()->json(['error' => 'Jadwal kerja tidak ditemukan.'], 404);
        }

        $hariKerja = json_decode($jadwalKerja->hari_kerja, true);

<<<<<<< HEAD
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
=======
        if (!in_array($hariIni, $hariKerja)) {
            return response()->json(['error' => 'Hari ini bukan hari kerja.'], 403);
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
        }

        // Ambil data absen masuk
        $absensi = Absensi::where('pengguna_id', $pengguna->id)
            ->whereDate('tanggal', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
            ->first();

        if (!$absensi) {
            return response()->json(['error' => 'Absen masuk tidak ditemukan.'], 404);
        }

        // Cegah absen dua kali
        if ($absensi->absen_pulang) {
            return response()->json(['error' => 'Sudah absen pulang hari ini.'], 403);
        }

        // Simpan data pulang
        $absensi->absen_pulang = Carbon::now('Asia/Jakarta');
        $absensi->lokasi_pulang_latitude = $request->input('latitude');
        $absensi->lokasi_pulang_longitude = $request->input('longitude');
        $absensi->save();

        return response()->json([
            'message' => 'Absen pulang berhasil',
            'absensi' => $absensi
        ], 200);
    }

    // Absen pulang awal
    public function PulangAwal(Request $request)
    {
        $pengguna = Auth::user();

        if (!$pengguna) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        $absensi = Absensi::where('pengguna_id', $pengguna->id)
            ->whereDate('tanggal', Carbon::now('Asia/Jakarta')->toDateString())
            ->first();

        if (!$absensi) {
            return response()->json(['error' => 'Data absensi tidak ditemukan'], 404);
        }

        $absensi->absen_pulang = Carbon::now('Asia/Jakarta')->format('H:i:s');
        $absensi->pulang_awal = true;
        $absensi->keterangan = $request->input('keterangan'); // opsional
        $absensi->lokasi_pulang_latitude = $request->input('latitude');
        $absensi->lokasi_pulang_longitude = $request->input('longitude');
        $absensi->save();

        return response()->json([
            'message' => 'Absen pulang awal berhasil ditandai',
            'absensi' => $absensi
        ], 200);
    }

    // Absen Izin
    public function absenIzin(Request $request)
    {
        $pengguna = Auth::user();

        if (!$pengguna) {
            return response()->json(['error' => 'Pengguna tidak ditemukan.'], 404);
        }

        // Validasi request secara keseluruhan
        $validated = $request->validate([
            'jenis' => 'required|in:Izin,Sakit',
            'keterangan' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Cek apakah sudah melakukan absensi hari ini
        $sudahAbsen = Absensi::where('pengguna_id', $pengguna->id)
            ->whereDate('tanggal', Carbon::now('Asia/Jakarta'))
            ->exists();

        if ($sudahAbsen) {
            return response()->json(['error' => 'Sudah melakukan absensi hari ini.'], 400);
        }

        // Simpan data izin atau sakit
        $absensi = new Absensi();
        $absensi->pengguna_id = $pengguna->id;
        $absensi->status = $validated['jenis'];
        $absensi->tanggal = Carbon::now('Asia/Jakarta');
        $absensi->keterangan = $validated['keterangan'];
        $absensi->lokasi_masuk_latitude = $validated['latitude'] ?? null;
        $absensi->lokasi_masuk_longitude = $validated['longitude'] ?? null;
        $absensi->save();

        return response()->json([
            'message' => "Absen {$validated['jenis']} berhasil.",
            'absensi' => $absensi
        ], 200);
    }

    //GET JADWAL KERJA
    public function getJadwalKerja()
    {
        $pengguna = Auth::user();
        $hariIni = strtolower(now()->locale('id')->translatedFormat('l')); // e.g., "selasa"

        $pengajuan = Pengajuan::where('pengguna_id', $pengguna->id)
            ->where('status', 'diterima')
            ->first();

        if (!$pengajuan) {
            return response()->json([
                'error' => 'Belum dapat absen sebelum pengajuan Diterima.'
            ], 404);
        }

        $jadwalHariIni = JadwalKerja::where('pengguna_id', $pengajuan->perusahaan_id)
            ->whereJsonContains('hari_kerja', $hariIni)
            ->first();

        if (!$jadwalHariIni) {
            return response()->json([
                'error' => 'Tidak ada jadwal saat ini!.'
            ], 403);
        }

        return response()->json([
            'hari_kerja' => $jadwalHariIni->hari_kerja,
            'jam_masuk'  => $jadwalHariIni->jam_masuk,
            'jam_keluar' => $jadwalHariIni->jam_keluar,
            'latitude'   => $jadwalHariIni->latitude,
            'longitude'  => $jadwalHariIni->longitude,
        ]);
    }


    // Riwayat Absensi
    public function riwayatAbsensi(Request $request)
    {
        $pengguna = Auth::user();

        if (!$pengguna) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        // Ambil bulan dan tahun dari request atau gunakan default saat ini
        $bulan = (int) $request->input('bulan', Carbon::now('Asia/Jakarta')->format('m'));
        $tahun = (int) $request->input('tahun', Carbon::now('Asia/Jakarta')->format('Y'));

        // Ambil data absensi berdasarkan pengguna dan filter waktu
        $absensiData = Absensi::where('pengguna_id', $pengguna->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Hitung statistik per status
        $statusList = ['Hadir', 'Terlambat', 'Izin', 'Sakit'];
        $statistik = [];

        foreach ($statusList as $status) {
            $statistik[strtolower($status)] = $absensiData->where('status', $status)->count();
        }

        return view('absensi.presensi', compact('absensiData', 'statistik', 'bulan', 'tahun'));
    }

    public function riwayatAbsensiAjax(Request $request)
    {
        $pengguna = Auth::user();

        if (!$pengguna) {
            return response()->json(['error' => 'Pengguna tidak ditemukan.'], 401);
        }

        $bulan = str_pad((string) $request->input('bulan'), 2, '0', STR_PAD_LEFT);
        $tahun = (string) $request->input('tahun');

<<<<<<< HEAD
        if (!$pengajuan) {
            return response()->json(['error' => 'Pengajuan tidak ditemukan'], 404);
        } 
=======
        // Validasi input bulan dan tahun
        if (!preg_match('/^(0?[1-9]|1[0-2])$/', $bulan) || !preg_match('/^\d{4}$/', $tahun)) {
            return response()->json(['error' => 'Format bulan atau tahun tidak valid.'], 422);
        }
>>>>>>> 44734077802f2dac236b168425133a99aa31d034

        $absensiData = Absensi::where('pengguna_id', $pengguna->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($item) {
                // Format tanggal secara konsisten
                $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
                return $item;
            });

        $statistik = [
            'hadir'     => $absensiData->where('status', 'Hadir')->count(),
            'terlambat' => $absensiData->where('status', 'Terlambat')->count(),
            'izin'      => $absensiData->where('status', 'Izin')->count(),
            'sakit'     => $absensiData->where('status', 'Sakit')->count(),
        ];

        return response()->json([
            'absensi'   => $absensiData,
            'statistik' => $statistik,
        ]);
    }
}
