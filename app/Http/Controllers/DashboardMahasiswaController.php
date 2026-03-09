<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard | RoomKos Daerah Cilegon Serang',
            'navlink' => 'Dashboard'
        ];
        return view('mahasiswa.dashboard', $data);
    }
}
