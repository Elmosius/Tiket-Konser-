<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role= DB::table('role')
        ->whereRaw('UPPER(nama_role) = ?', [strtoupper('admin')])
        ->value('id');
        // dd($role);

        // Cek apakah user terautentikasi dan apakah role-nya adalah 'admin'
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman home atau tampilkan error
        return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat halaman tersebut');
    }
}
