<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    //Notifikasi
    public function notif()
    {
        if (view()->exists('admin.notif')) {
            return view('admin.notif');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function showNotif()
    {
        $notifikasi = Notifikasi::orderBy('created_at', 'desc')->get();
        return view('admin.notif', compact('notifikasi'));
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::find($id);

        if (!$notifikasi) {
            return redirect()->back()->with('error', 'Notifikasi tidak ditemukan.');
        }

        $notifikasi->delete();
        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus!');
    }



    //Kontak siswa
    public function kontak()
    {
        if (view()->exists('absensi.kontak')) {
            return view('absensi.kontak');
        } else {
            return "View tidak ditemukan.";
        }
    }

    public function storeNotif(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        Notifikasi::create([
            'pengguna_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pesan telah berhasil dikirim!',
            ]);
        }

        // Jika bukan AJAX (fallback)
        return redirect()->route('beranda')->with('success', 'Pesan telah berhasil dikirim!');
    }
}
