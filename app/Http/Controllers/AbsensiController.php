<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
 public function absenMasuk(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:pengguna,id',
        'jam_masuk' => 'required|date_format:H:i:s'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
        ], 422);
    }

    // Cek apakah user sudah absen hari ini
    $absensiHariIni = Absensi::where('user_id', $request->user_id)
                             ->where('tanggal', now()->toDateString())
                             ->first();

    if ($absensiHariIni) {
        return response()->json([
            'message' => 'Anda sudah absen hari ini!',
            'data' => $absensiHariIni
        ], 400);
    }

    // Menentukan status berdasarkan jam masuk
    $status = ($request->jam_masuk > '07:30:00') ? 'Terlambat' : 'Hadir';

    try {
        // Simpan absensi masuk
        $absensi = Absensi::create([
            'user_id' => $request->user_id,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => $request->jam_masuk,
            'status' => $status
        ]);

        return response()->json([
            'message' => 'Absensi masuk berhasil',
            'data' => $absensi
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Gagal menyimpan data',
            'error' => $e->getMessage()
        ], 500);
    }
    if (!auth()->check()) {
    return response()->json(['message' => 'User belum login!'], 401);
}
$userId = auth()->user()->id;
}


    public function absenPulang(Request $request)
    {
        Absensi::where('user_id', $request->user_id)
            ->where('tanggal', now()->toDateString())
            ->update(['jam_keluar' => $request->jam_keluar]);

        return response()->json(['message' => 'Absensi pulang berhasil']);
    }

    public function absenIzin(Request $request)
    {
        Absensi::create([
            'user_id' => $request->user_id,
            'tanggal' => now()->toDateString(),
            'status' => $request->status,
            'alasan' => $request->alasan
        ]);

        return response()->json(['message' => 'Absensi izin/sakit berhasil']);
    }

    public function riwayatAbsensi($userId)
    {
        $data = Absensi::where('user_id', $userId)->orderBy('tanggal', 'desc')->get();
        return response()->json($data);
    }

public function rekapBulanan()
{
    $bulanIni = now()->format('m');
    $dataBulanan = Absensi::whereMonth('tanggal', $bulanIni)
        ->selectRaw('status, COUNT(*) as jumlah')
        ->groupBy('status')
        ->get();

    return view('rekap.bulanan', compact('dataBulanan'));
}
}
