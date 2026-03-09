<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user) {
            return back()
                ->withErrors([
                    'email' => 'Email tidak ditemukan.',
                ])
                ->withInput($request->only('email'));
        }

        if ($user->role !== 'mahasiswa') {
            return back()
                ->withErrors([
                    'email' => 'Akun ini bukan akun mahasiswa.',
                ])
                ->withInput($request->only('email'));
        }

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            return redirect()->route('mahasiswa.dashboard')
                ->with('success', 'Login berhasil. Selamat datang!');
        }

        return back()
            ->withErrors([
                'password' => 'Password yang kamu masukkan salah.',
            ])
            ->withInput($request->only('email'));
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama terlalu panjang.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('mahasiswa.dashboard')
            ->with('success', 'Registrasi berhasil. Selamat datang di RoomKos!');
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('mahasiswa.login')
            ->with('success', 'Selamat, Berhasil Logout');
    }
}
