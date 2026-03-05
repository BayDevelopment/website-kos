<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function terms()
    {
        $data = [
            'title' => 'Syarat & Ketentuan | RoomKos - Daerah Cilegon & Serang'
        ];
        return view('legal.terms', $data);
    }
    public function privacy()
    {
        $data = [
            'title' => 'privacy | RoomKos - Daerah Cilegon & Serang'
        ];
        return view('legal.privacy', $data);
    }
}
