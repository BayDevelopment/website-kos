<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureMahasiswaIdentitasComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'mahasiswa') {
            return $next($request);
        }

        $identitas = $user->identitasMahasiswa;

        if (
            (!$identitas || !$identitas->is_complete) &&
            ! $request->routeIs(
                'mahasiswa.profile.identitas.edit',
                'mahasiswa.profile.identitas.update',
                'logout'
            )
        ) {
            return redirect()
                ->route('mahasiswa.profile.identitas.edit')
                ->with('warning', 'Silakan lengkapi identitas terlebih dahulu.');
        }

        return $next($request);
    }
}
