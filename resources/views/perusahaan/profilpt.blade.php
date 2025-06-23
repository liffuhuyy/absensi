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
        $perusahaan = Perusahaan::all();
        return view('perusahaan.index', compact('perusahaan'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('perusahaan.create');
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

    // Tampilkan form edit
    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('perusahaan.edit', compact('perusahaan'));
    }

    // Update data perusahaan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:perusahaan,email,' . $id,
            'telepon' => 'required|string',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $perusahaan = Perusahaan::findOrFail($id);
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

    // Hapus perusahaan
    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil dihapus!');
    }

    // Tampilkan data perusahaan untuk detail AJAX
    public function show($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return response()->json($perusahaan);
    }

    // Tampilkan profil perusahaan milik user login
    public function profilpt()
    {
        $perusahaan = Perusahaan::where('pengguna_id', Auth::id())->first();

        // Tambahkan pengecekan agar tidak error saat $perusahaan null
        if (!$perusahaan) {
            return redirect()->route('perusahaan.create')->with('warning', 'Silakan lengkapi data perusahaan Anda terlebih dahulu.');
        }

        return view('perusahaan.profilpt', compact('perusahaan'));
    }
}
