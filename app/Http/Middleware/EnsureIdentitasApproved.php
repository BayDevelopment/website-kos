<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureIdentitasApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $identitas = $user->identitasMahasiswa;

        if (!$identitas) {
            return redirect()->route('mahasiswa.profile.identitas.edit');
        }

        if ($identitas->verification_status !== 'approved') {
            if ($request->routeIs(
                'mahasiswa.profile.identitas.show',
                'logout'
            )) {
                return $next($request);
            }

            return redirect()
                ->route('mahasiswa.profile.identitas.show')
                ->with('warning', 'Tunggu hingga identitas Anda disetujui admin.');
        }

        return $next($request);
    }
}
