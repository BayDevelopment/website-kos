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

        // Kalau belum ada identitas, hanya boleh ke halaman edit/update
        if (
            !$identitas &&
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

        // Kalau identitas sudah ada, mahasiswa tidak boleh balik ke form edit/update lagi
        if (
            $identitas &&
            $request->routeIs(
                'mahasiswa.profile.identitas.edit',
                'mahasiswa.profile.identitas.update'
            )
        ) {
            return redirect()
                ->route('mahasiswa.profile.identitas.show')
                ->with('warning', 'Identitas sudah dikirim dan tidak dapat diubah.');
        }

        return $next($request);
    }
}
