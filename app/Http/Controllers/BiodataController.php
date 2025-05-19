<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;

class BiodataController extends Controller
{
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
        'nisn' => 'required|unique:biodata|string',
        'nohp' => 'required|string',
        'email' => 'required|unique:biodata|email',
        'jenis_kelamin' => 'required|string',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'jurusan' => 'required|string',
        'kelas' => 'required|string',
        'agama' => 'required|string',
        'alamat' => 'required|string',
    ]);

    Biodata::updateOrCreate(['id' => 1], $request->all());

    return redirect()->back()->with('success', 'Data biodata berhasil diperbarui!');
}

public function update(Request $request, $id)
{
    $biodata = Biodata::findOrFail($id);
    $biodata->update($request->all());

    return redirect()->route('biodata.index')->with('success', 'Data berhasil diperbarui!');
}

public function show($id)
{
    $biodata = Biodata::findOrFail($id);
    return view('absensi.profil', compact('biodata'));
}
}