<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
    $pengguna = Auth::user();

    if ($pengguna->role !== $role) {
    return redirect('/login')->with('error', 'Anda harus login terlebih dahulu untuk mengakses halaman ini.');}

    return $next($request);
    }
}