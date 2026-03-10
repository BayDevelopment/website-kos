<?php

namespace App\Http\Controllers;

use App\Models\IdentitasPemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PemilikIdentitasController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM CREATE IDENTITAS
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $user = Auth::user();

        $identitas = $user->identitasPemilik;

        // Jika sudah isi identitas maka redirect ke detail
        if ($identitas && $identitas->is_complete) {
            return redirect()->route('pemilik.identitas.show');
        }

        return view('pemilik.create', compact('identitas'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN IDENTITAS PEMILIK
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->identitasPemilik) {
            return redirect()->route('pemilik.identitas.show');
        }

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'nik' => ['required', 'digits:16', 'unique:identitas_pemilik,nik'],
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'alamat' => ['required', 'string'],
            'no_wa' => ['required', 'string', 'max:20'],
            'nama_usaha' => ['required', 'string', 'max:150'],
            'status_pengelola' => ['required', 'in:pemilik,pengelola,agen'],

            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            'foto_ktp' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'foto_selfie' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload file
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')
                ->store('pemilik/avatar', 'public');
        }

        $validated['foto_ktp'] = $request->file('foto_ktp')
            ->store('pemilik/ktp', 'public');

        $validated['foto_selfie'] = $request->file('foto_selfie')
            ->store('pemilik/selfie', 'public');

        /*
        |--------------------------------------------------------------------------
        | Simpan ke database
        |--------------------------------------------------------------------------
        */

        $validated['user_id'] = $user->id;
        $validated['is_complete'] = true;
        $validated['verification_status'] = 'pending';

        IdentitasPemilik::create($validated);

        return redirect()
            ->route('pemilik.identitas.show')
            ->with('success', 'Identitas berhasil dikirim. Menunggu verifikasi admin.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW IDENTITAS (READ ONLY)
    |--------------------------------------------------------------------------
    */

    public function show()
    {
        $user = Auth::user();

        $identitas = $user->identitasPemilik;

        if (!$identitas) {
            return redirect()->route('pemilik.profile.identitas.create');
        }

        return view('pemilik.show', compact('identitas'));
    }
}
