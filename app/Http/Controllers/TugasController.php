<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTugas;

class TugasController extends Controller
{

    public function showTugas()
    {
        $tugas = UserTugas::all();
        return view('absensi.manajementugas', compact('tugas'));
    }

    public function filter(Request $request)
    {
        $bulan = $request->bulan;
        $tugas = UserTugas::whereMonth('tanggal', $bulan)->get();

        return view('absensi.manajementugas', compact('tugas', 'bulan'));
    }

    public function simpanTugas(Request $request)
    {
        try {
            UserTugas::create([
                'tanggal' => $request->tanggal,
                'tugas' => $request->tugas
            ]);
            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }

        $tugas = UserTugas::all();
        return response()->json($tugas);
    }
}
