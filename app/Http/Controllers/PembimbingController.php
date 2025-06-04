<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing; // Pastikan model Pembimbing sudah ada

class PembimbingController extends Controller
{
    // Menampilkan halaman data pembimbing
    public function index()
    {
        $pembimbing = Pembimbing::all();
        return view('admin.datapembimbing', compact('pembimbing'));
    }

    // Menyimpan data pembimbing baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'nip' => 'required|string|unique:pembimbing,nip',
                'jurusan' => 'required|string',
                'kelas' => 'required|string',
                'no_hp' => 'required|string',
                'email' => 'required|email|unique:pembimbing,email'
            ]);

            Pembimbing::create([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'jurusan' => $request->jurusan,
                'kelas' => $request->kelas,
                'no_hp' => $request->no_hp,
                'email' => $request->email
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data pembimbing berhasil ditambahkan!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update data pembimbing
    public function update(Request $request, $id)
    {
        try {
            $pembimbing = Pembimbing::findOrFail($id);
            
            $request->validate([
                'nama' => 'required|string|max:255',
                'nip' => 'required|string|unique:pembimbing,nip,' . $id,
                'jurusan' => 'required|string',
                'kelas' => 'required|string',
                'no_hp' => 'required|string',
                'email' => 'required|email|unique:pembimbing,email,' . $id
            ]);

            $pembimbing->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'jurusan' => $request->jurusan,
                'kelas' => $request->kelas,
                'no_hp' => $request->no_hp,
                'email' => $request->email
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data pembimbing berhasil diupdate!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    // Hapus data pembimbing
    public function destroy($id)
    {
        try {
            $pembimbing = Pembimbing::findOrFail($id);
            $pembimbing->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data pembimbing berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}