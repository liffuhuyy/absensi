<?php

namespace App\Http\Controllers;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    // Menyimpan pengguna ke database
    public function store(Request $request)
    {
        $request->validate([
            'namaPengguna' => 'required|string|max:255',
            'emailPengguna' => 'required|email|unique:pengguna,email',
            'passwordPengguna' => 'required|string|min:6',
            'role' => 'required|in:user,perusahaan,admin' // Pastikan role valid
        ]);

        Pengguna::create([
            'nama' => $request->namaPengguna,
            'email' => $request->emailPengguna,
            'password' => Hash::make($request->passwordPengguna),
            'role' => $request->role
        ]);

        return response()->json(['message' => 'Pengguna berhasil ditambahkan!']);
    }

    // Menampilkan daftar pengguna
public function index()
{
    $pengguna = Pengguna::all(); // Ambil semua data pengguna
    return view('admin.pengguna', compact('pengguna')); // Redirect ke halaman
}

    // Proses login dan redirect berdasarkan role
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $pengguna = Auth::user();

            if ($pengguna->role === 'user') {
                return redirect('/beranda');
            } elseif ($pengguna->role === 'perusahaan') {
                return redirect('/dashboardpt');
            } elseif ($pengguna->role === 'admin') {
                return redirect('/dashboardmin');
            }
        }

        return back()->withErrors(['message' => 'Email atau password salah']);
    }

     public function hapus($id)
    {
        try {
            $pengguna = pengguna::findOrFail($id);
            $pengguna->delete();

            return response()->json([
                'message' => 'Pengguna berhasil dihapus.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

}