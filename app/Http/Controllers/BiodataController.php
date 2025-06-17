<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    //Profil
    public function profil()
    {
        $biodata = Biodata::whereNotNull('nohp')->get();
        return view('absensi.profil', compact('biodata'));
    }


    //Biodata
    public function index()
    {
        // Ambil data biodata pertama yang ada
        $biodata = Biodata::first();
        return view('absensi.biodata', compact('biodata'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nisn' => 'required|unique:biodata,nisn,' . Auth::id() . ',pengguna_id',
            'nohp' => 'required|string',
            'email' => 'required|unique:biodata,email,' . Auth::id() . ',pengguna_id',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jurusan' => 'required|string',
            'kelas' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $data = $request->all();
        $data['pengguna_id'] = Auth::id(); // Tambahkan ID pengguna yang sedang login

        // Update jika sudah ada, atau create jika belum
        Biodata::updateOrCreate(
            ['pengguna_id' => Auth::id()],
            $data
        );

        return redirect()->route('profil')->with('success', 'Data biodata berhasil diperbarui!');
    }

    public function update(Request $request, $id)
    {
        $biodata = Biodata::findOrFail($id);
        $biodata->update($request->all());

        return redirect()->route('profil')->with('success', 'Data biodata berhasil diperbarui!');
    }

    public function show($id)
    {
        $biodata = Biodata::findOrFail($id);
        return view('absensi.profil', compact('biodata'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $pengguna = Auth::user();

        // Ambil data biodata milik pengguna
        $biodata = Biodata::where('pengguna_id', $pengguna->id)->first();

        if (!$biodata) {
            return back()->with('error', 'Biodata tidak ditemukan.');
        }

        // Hapus foto lama jika ada
        if ($biodata->foto && Storage::disk('public')->exists($biodata->foto)) {
            Storage::disk('public')->delete($biodata->foto);
        }

        // Simpan foto baru
        $path = $request->file('foto')->store('foto-profil', 'public');

        // Update kolom foto di biodata
        $biodata->foto = $path;
        $biodata->save();

        return back()->with('success', 'Foto berhasil diperbarui!');
    }
}
