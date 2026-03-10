<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsurePemilikApproved
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

        if (!$identitas || $identitas->verification_status !== 'approved') {
            return redirect()->route('pemilik.identitas.show')
                ->with('error', 'Akun Anda belum disetujui admin. Anda belum dapat mengakses fitur ini.');
        }

        return $next($request);
    }
}
