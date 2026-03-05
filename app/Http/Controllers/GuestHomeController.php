<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;

class GuestHomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'RoomKos | Kos-kosan daerah Cilegon & Serang',
        ];
        return view('guest.homepage', $data);
    }
}
