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
            'no_wa' => ['required', 'regex:/^[0-9+\-\s]+$/', 'max:20'],
            'nama_usaha' => ['required', 'string', 'max:150'],
            'status_pengelola' => ['required', 'in:pemilik,pengelola,agen'],

            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            'foto_ktp' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            'foto_selfie' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 100 karakter.',

            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'alamat.string' => 'Alamat lengkap harus berupa teks.',

            'no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'no_wa.string' => 'Nomor WhatsApp harus berupa teks.',
            'no_wa.max' => 'Nomor WhatsApp maksimal 20 karakter.',
            'no_wa.regex' => 'Nomor WhatsApp hanya boleh berisi angka, spasi, tanda plus, atau tanda minus.',

            'nama_usaha.required' => 'Nama usaha / nama kos wajib diisi.',
            'nama_usaha.string' => 'Nama usaha / nama kos harus berupa teks.',
            'nama_usaha.max' => 'Nama usaha / nama kos maksimal 150 karakter.',

            'status_pengelola.required' => 'Status pengelola wajib dipilih.',
            'status_pengelola.in' => 'Status pengelola tidak valid.',

            'avatar.image' => 'Foto profil harus berupa gambar.',
            'avatar.mimes' => 'Foto profil harus berformat JPG, JPEG, atau PNG.',
            'avatar.max' => 'Ukuran foto profil maksimal 1 MB.',

            'foto_ktp.required' => 'Foto KTP wajib diupload.',
            'foto_ktp.image' => 'Foto KTP harus berupa gambar.',
            'foto_ktp.mimes' => 'Foto KTP harus berformat JPG, JPEG, atau PNG.',
            'foto_ktp.max' => 'Ukuran foto KTP maksimal 2 MB.',

            'foto_selfie.required' => 'Foto selfie dengan KTP wajib diupload.',
            'foto_selfie.image' => 'Foto selfie dengan KTP harus berupa gambar.',
            'foto_selfie.mimes' => 'Foto selfie dengan KTP harus berformat JPG, JPEG, atau PNG.',
            'foto_selfie.max' => 'Ukuran foto selfie dengan KTP maksimal 2 MB.',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('pemilik/avatar', 'public');
        }

        $validated['foto_ktp'] = $request->file('foto_ktp')->store('pemilik/ktp', 'public');
        $validated['foto_selfie'] = $request->file('foto_selfie')->store('pemilik/selfie', 'public');

        $validated['user_id'] = $user->id;
        $validated['is_complete'] = true;
        $validated['verification_status'] = 'pending';

        IdentitasPemilik::create($validated);

        // dd($request->all(), $request->file());
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
