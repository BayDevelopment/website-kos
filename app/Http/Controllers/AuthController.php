<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnValue;

class AuthController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login | RoomKos - Daerah Cilegon & Serang'
        ];
        return view('auth.login', $data);
    }


    public function register()
    {
        $data = [
            'title' => 'Register | RoomKos - Daerah Cilegon & Serang'
        ];
        return view('auth.register', $data);
    }
}
