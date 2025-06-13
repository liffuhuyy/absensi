<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;

class PenilaianController extends Controller
{
    public function penilaian()
    {
        if (view()->exists('absensi.penilaian')) {
            return view('absensi.penilaian');
        } else {
            return "View tidak ditemukan.";
        }
    }
}
