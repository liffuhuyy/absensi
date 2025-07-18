<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    // Menampilkan daftar semua perusahaan
    public function index()
    {
        $perusahaan = Perusahaan::where('pengguna_id', Auth::id())->first();
        return view('perusahaan.profilpt', compact('perusahaan'));
    }

    // Simpan data perusahaan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:perusahaan,email',
            'telepon' => 'required|string',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : null;

        Perusahaan::create([
            'pengguna_id' => Auth::id(),
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'deskripsi' => $request->deskripsi,
            'logo' => $logoPath,
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil disimpan!');
    }

    // Tampilkan form untuk edit
    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        // Cegah edit data orang lain
        if ($perusahaan->pengguna_id !== Auth::id()) {
            abort(403);
        }

        return view('perusahaan.profilpt', compact('perusahaan'));
    }

    // Proses update data
    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        if ($perusahaan->pengguna_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:perusahaan,email,' . $id,
            'telepon' => 'required|string',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : $perusahaan->logo;

        $perusahaan->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'deskripsi' => $request->deskripsi,
            'logo' => $logoPath,
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil diperbarui!');
    }

    // Endpoint untuk ambil data 1 perusahaan via AJAX
    public function getData($id)
    {
        $perusahaan = Perusahaan::find($id);

        if (!$perusahaan || $perusahaan->pengguna_id !== Auth::id()) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($perusahaan);
    }

    // Endpoint untuk AJAX (get semua perusahaan milik user)
    public function json()
    {
        return response()->json(
            Perusahaan::where('pengguna_id', Auth::id())->get()
        );
    }
}
