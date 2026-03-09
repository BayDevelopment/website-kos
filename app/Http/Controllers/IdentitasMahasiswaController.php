<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdentitasMahasiswaController extends Controller
{

    public function edit()
    {
        $identitas = Auth::user()->identitasMahasiswa;

        return view('mahasiswa.edit', [
            'title' => 'Lengkapi Identitas | RoomKos Daerah Cilegon & Serang',
            'navlink' => 'Lengkapi Identitas',
            'identitas' => $identitas
        ]);
    }
}
