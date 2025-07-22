<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class BiodataController extends Controller
{
    //Profil
    public function profil()
    {
        $pengguna = Auth::user();
        $biodata = Biodata::where('pengguna_id', $pengguna->id)->get();

        return view('absensi.profil', compact('biodata'));
    }


    //Biodata
    public function index()
    {
        $pengguna = Auth::user();

        $biodata = Biodata::where('pengguna_id', $pengguna->id)->first();

        return view('absensi.biodata', compact('biodata'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nisn' => 'required|unique:biodata,nisn',
            'nohp' => 'required|string',
            'email' => 'required|unique:biodata,email',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jurusan' => 'required|string',
            'kelas' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $data = $request->only([
            'nama',
            'nisn',
            'nohp',
            'email',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'jurusan',
            'kelas',
            'agama',
            'alamat'
        ]);
        $data['pengguna_id'] = Auth::id();

        Biodata::create($data);

        return redirect()->route('profil')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $biodata = Biodata::findOrFail($id);

        if ($biodata->pengguna_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama' => 'required|string',
            'nisn' => [
                'required',
                Rule::unique('biodata')->ignore($biodata->id),
            ],
            'nohp' => 'required|string',
            'email' => [
                'required',
                Rule::unique('biodata')->ignore($biodata->id),
            ],
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jurusan' => 'required|string',
            'kelas' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $biodata->update($request->only([
            'nama',
            'nisn',
            'nohp',
            'email',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'jurusan',
            'kelas',
            'agama',
            'alamat'
        ]));

        return redirect()->route('profil')->with('success', 'Data biodata berhasil diperbarui!');
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
