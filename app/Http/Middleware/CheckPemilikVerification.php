<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPemilikVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'pemilik_kos') {
            abort(403, 'Akses ditolak.');
        }

        $identitas = $user->identitasPemilik;
        $currentRoute = $request->route()?->getName();

        $allowedRoutesWhenNoIdentity = [
            'pemilik.profile.identitas.create',
            'pemilik.profile.identitas.store',
            'logout',
        ];

        $allowedRoutesWhenPending = [
            'pemilik.identitas.show',
            'logout',
        ];

        // Belum isi identitas
        if (!$identitas || !$identitas->is_complete) {
            if (!in_array($currentRoute, $allowedRoutesWhenNoIdentity)) {
                return redirect()->route('pemilik.profile.identitas.create');
            }

            return $next($request);
        }

        // Sudah isi tapi belum approved
        if ($identitas->verification_status !== 'approved') {
            if (!in_array($currentRoute, $allowedRoutesWhenPending)) {
                return redirect()->route('pemilik.identitas.show');
            }

            return $next($request);
        }

        return $next($request);
    }
}
