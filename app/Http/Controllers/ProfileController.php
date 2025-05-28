<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = auth()->user(); // pastikan user login

    // Simpan gambar profil jika diupload
    if ($request->hasFile('profile_picture')) {
        if ($user->biodata && $user->biodata->foto_profil) {
            Storage::delete('public/' . $user->biodata->foto_profil); // hapus lama
        }

        $path = $request->file('profile_picture')->store('foto_profil', 'public');
        $user->biodata->foto_profil = $path;
    }

    $user->biodata->nama = $request->name;
    $user->biodata->nohp = $request->phone;
    $user->biodata->email = $request->email;
    $user->biodata->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui');
}
