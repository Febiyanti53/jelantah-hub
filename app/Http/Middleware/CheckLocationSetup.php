<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLocationSetup
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // Stakeholder dikecualikan karena tidak mengumpulkan minyak di lapangan secara langsung
            if ($user->role !== 'stakeholder') {
                
                // Jika latitude atau longitude masih kosong
                if (is_null($user->latitude) || is_null($user->longitude)) {
                    
                    // Supaya tidak terjadi looping terus-menerus saat mengakses halaman profil itu sendiri
                    if (!$request->routeIs('profile.*')) {
                        return redirect()->route('profile.edit')
                            ->with('warning', 'Anda wajib melengkapi lokasi koordinat (Latitude & Longitude) terlebih dahulu untuk menggunakan fitur platform.');
                    }
                }
            }
        }

        return $next($request);
    }
}