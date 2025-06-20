<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function showTugas()
    {
        $tugas = Tugas::where('pengguna_id', Auth::id())->get(); // hanya data user login
        return view('absensi.manajementugas', compact('tugas'));
    }

    public function simpanTugas(Request $request)
    {
        try {
            Tugas::create([
                'tanggal' => $request->tanggal,
                'tugas' => $request->tugas,
                'pengguna_id' => Auth::id(), // menyimpan id user login
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function filter(Request $request)
    {
        $bulan = $request->bulan;

        $tugas = Tugas::whereMonth('tanggal', $bulan)
            ->where('pengguna_id', Auth::id()) // hanya data milik user login
            ->get();

        return view('absensi.manajementugas', compact('tugas', 'bulan'));
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        return redirect()->route('absensi.manajementugas')->with('success', 'Tugas berhasil dihapus.');
    }
}
