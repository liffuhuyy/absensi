<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    
public function store(Request $request)
{
    $validatedData = $request->validate([
        'status' => 'required|in:Hadir,Terlambat,Izin,Sakit',
        'keterangan' => 'nullable|string',
    ]);

    Absensi::create($validatedData);

    return response()->json(['message' => 'Data absensi berhasil disimpan']);
}

public function getAbsensiData()
{
    return [
        'hadir' => Absensi::where('status', 'Hadir')->count(),
        'terlambat' => Absensi::where('status', 'Terlambat')->count(),
        'izin' => Absensi::where('status', 'Izin')->count(),
        'sakit' => Absensi::where('status', 'Sakit')->count(),
        'jumlahAbsensi' => Absensi::count(),
        'absensiData' => Absensi::orderBy('tanggal', 'desc')->get()
    ];
}
public function absensi(Request $request)
{
    $data = $this->getAbsensiData();
    return view('absensi.presensi', compact('data'));
}

public function laporan()
{
    $data = $this->getAbsensiData();
    return view('perusahaan.dashboardpt', compact('data'));
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

public function izin(Request $request)
{
    $request->validate([
        'jenis_izin' => 'required|in:Izin,Sakit',
        'alasan_izin' => 'required|string',
    ]);

    Absensi::create([
        'tanggal' => now()->toDateString(),
        'status' => $request->jenis_izin,
        'keterangan' => $request->alasan_izin,
    ]);

    return response()->json(['message' => 'Data izin/sakit berhasil disimpan!']);
}

public function pulangAwal(Request $request)
{
    $request->validate([
        'alasan_pulang_cepat' => 'required|string',
    ]);

    Absensi::create([
        'tanggal' => now()->toDateString(),
        'status' => 'Pulang Lebih Awal',
        'keterangan' => $request->alasan_pulang_cepat,
    ]);

    return response()->json(['message' => 'Alasan pulang lebih awal berhasil disimpan!']);
}
}
