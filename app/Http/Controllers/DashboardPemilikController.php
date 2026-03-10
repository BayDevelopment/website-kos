<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Pemilik | RoomKos Daerah Cilegon & Serang'
        ];
        return view('pemilik.dashboard', $data);
    }
}
