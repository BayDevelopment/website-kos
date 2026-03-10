<?php

namespace App\Http\Controllers;

use App\Models\IdentitasMahasiswa;
use App\Models\Universitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class IdentitasMahasiswaController extends Controller
{

    public function edit()
    {
        $identitas = Auth::user()->identitasMahasiswa;

        $universitas = Universitas::where('is_active', true)
            ->orderBy('nama_universitas')
            ->get();

        return view('mahasiswa.edit', [
            'title' => 'Lengkapi Identitas | RoomKos Daerah Cilegon & Serang',
            'navlink' => 'Lengkapi Identitas',
            'identitas' => $identitas,
            'universitas' => $universitas
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $identitas = $user->identitasMahasiswa;

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'universitas_id' => ['required', 'exists:universitas,id'],
            'semester' => ['required', 'integer', 'min:1', 'max:14'],
            'nik' => [
                'required',
                'string',
                'max:20',
                Rule::unique('identitas_mahasiswas', 'nik')->ignore($identitas?->id),
            ],
            'jenis_kelamin' => ['required', Rule::in(['laki-laki', 'perempuan'])],
            'asal_kota' => [
                'required',
                Rule::in(['Kota Cilegon', 'Kota Serang'])
            ],
            'alamat' => ['required', 'string'],
            'no_wa' => ['required', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($identitas && $identitas->avatar && Storage::disk('public')->exists($identitas->avatar)) {
                Storage::disk('public')->delete($identitas->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('avatars/mahasiswa', 'public');
        }

        $validated['user_id'] = $user->id;
        $validated['is_complete'] = true;

        $validated['verification_status'] = 'pending';
        $validated['verification_note'] = null;
        $validated['verified_at'] = null;

        IdentitasMahasiswa::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()
            ->route('mahasiswa.profile.identitas.show')
            ->with('success', 'Identitas berhasil disimpan. Tunggu verifikasi admin.');
    }

    public function show()
    {
        $identitas = Auth::user()->identitasMahasiswa;

        if (!$identitas) {
            return redirect()
                ->route('mahasiswa.profile.identitas.edit')
                ->withErrors([
                    'identitas' => 'Silakan lengkapi identitas terlebih dahulu.'
                ]);
        }

        return view('mahasiswa.detail-identitas', [
            'title' => 'Detail Identitas | RoomKos Daerah Cilegon & Serang',
            'navlink' => 'Detail Identitas',
            'identitas' => $identitas
        ]);
    }
}
