<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Pembimbing::query();

            // Filter berdasarkan jurusan jika ada
            if ($request->has('jurusan') && $request->jurusan != '') {
                $query->byJurusan($request->jurusan);
            }

            // Pencarian jika ada
            if ($request->has('search') && $request->search != '') {
                $query->search($request->search);
            }

            // Urutkan berdasarkan nama
            $pembimbing = $query->orderBy('nama', 'asc')->get();

            // Jika request AJAX, return JSON
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'data' => $pembimbing
                ]);
            }

            // Return view untuk halaman normal
            return view('admin.data-pembimbing', compact('pembimbing'));

        } catch (\Exception $e) {
            Log::error('Error in PembimbingController@index: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memuat data'
                ], 500);
            }

            return back()->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|min:3',
            'nip' => 'required|string|max:20|unique:pembimbing,nip',
            'jurusan' => 'required|in:RPL,TKJ,MM,OTKP,AKL,BDP',
            'kelas' => 'required|string|max:50',
            'no_hp' => 'required|string|max:15|regex:/^[0-9+\-\s]+$/',
            'email' => 'required|email|max:255|unique:pembimbing,email',
        ], [
            'nama.required' => 'Nama pembimbing harus diisi',
            'nama.min' => 'Nama pembimbing minimal 3 karakter',
            'nip.required' => 'NIP harus diisi',
            'nip.unique' => 'NIP sudah terdaftar',
            'jurusan.required' => 'Jurusan harus dipilih',
            'jurusan.in' => 'Jurusan tidak valid',
            'kelas.required' => 'Kelas harus diisi',
            'no_hp.required' => 'Nomor HP harus diisi',
            'no_hp.regex' => 'Format nomor HP tidak valid',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $pembimbing = Pembimbing::create([
                'nama' => trim($request->nama),
                'nip' => trim($request->nip),
                'jurusan' => $request->jurusan,
                'kelas' => trim($request->kelas),
                'no_hp' => trim($request->no_hp),
                'email' => strtolower(trim($request->email)),
            ]);

            DB::commit();

            Log::info('Pembimbing baru ditambahkan: ' . $pembimbing->nama . ' (ID: ' . $pembimbing->id . ')');

            return response()->json([
                'success' => true,
                'message' => 'Data pembimbing berhasil ditambahkan!',
                'data' => $pembimbing
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in PembimbingController@store: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $pembimbing = Pembimbing::with(['siswa', 'kelas'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $pembimbing
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembimbing tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $pembimbing = Pembimbing::findOrFail($id);

            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:255|min:3',
                'nip' => 'required|string|max:20|unique:pembimbing,nip,' . $id,
                'jurusan' => 'required|in:RPL,TKJ,MM,OTKP,AKL,BDP',
                'kelas' => 'required|string|max:50',
                'no_hp' => 'required|string|max:15|regex:/^[0-9+\-\s]+$/',
                'email' => 'required|email|max:255|unique:pembimbing,email,' . $id,
            ], [
                'nama.required' => 'Nama pembimbing harus diisi',
                'nama.min' => 'Nama pembimbing minimal 3 karakter',
                'nip.required' => 'NIP harus diisi',
                'nip.unique' => 'NIP sudah terdaftar',
                'jurusan.required' => 'Jurusan harus dipilih',
                'jurusan.in' => 'Jurusan tidak valid',
                'kelas.required' => 'Kelas harus diisi',
                'no_hp.required' => 'Nomor HP harus diisi',
                'no_hp.regex' => 'Format nomor HP tidak valid',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $pembimbing->update([
                'nama' => trim($request->nama),
                'nip' => trim($request->nip),
                'jurusan' => $request->jurusan,
                'kelas' => trim($request->kelas),
                'no_hp' => trim($request->no_hp),
                'email' => strtolower(trim($request->email)),
            ]);

            DB::commit();

            Log::info('Data pembimbing diupdate: ' . $pembimbing->nama . ' (ID: ' . $pembimbing->id . ')');

            return response()->json([
                'success' => true,
                'message' => 'Data pembimbing berhasil diupdate!',
                'data' => $pembimbing
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembimbing tidak ditemukan'
            ], 404);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in PembimbingController@update: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pembimbing = Pembimbing::findOrFail($id);

            // Cek apakah pembimbing masih memiliki siswa
            if ($pembimbing->siswa()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus pembimbing yang masih memiliki siswa bimbingan'
                ], 400);
            }

            DB::beginTransaction();

            $nama = $pembimbing->nama;
            $pembimbing->delete();

            DB::commit();

            Log::info('Pembimbing dihapus: ' . $nama . ' (ID: ' . $id . ')');

            return response()->json([
                'success' => true,
                'message' => 'Data pembimbing berhasil dihapus!'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembimbing tidak ditemukan'
            ], 404);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in PembimbingController@destroy: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get pembimbing by jurusan
     */
    public function getByJurusan(Request $request, $jurusan)
    {
        try {
            $pembimbing = Pembimbing::byJurusan($jurusan)
                                   ->orderBy('nama', 'asc')
                                   ->get();

            return response()->json([
                'success' => true,
                'data' => $pembimbing
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memuat data'
            ], 500);
        }
    }

    /**
     * Export data pembimbing
     */
    public function export(Request $request)
    {
        try {
            $pembimbing = Pembimbing::orderBy('nama', 'asc')->get();

            // Logic untuk export (Excel, PDF, dll)
            // Implementasi sesuai kebutuhan

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diekspor'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengekspor data'
            ], 500);
        }
    }
}