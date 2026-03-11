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
        return view('auth.login', [
            'title' => 'Login | RoomKos - Daerah Cilegon & Serang',
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'Register | RoomKos - Daerah Cilegon & Serang',
        ]);
    }

    public function registerPemilik()
    {
        return view('auth.pemilik-register', [
            'title' => 'Register | RoomKos - Daerah Cilegon & Serang',
        ]);
    }

    protected function redirectByRole($user)
    {
        return match ($user->role) {
            'mahasiswa' => route('mahasiswa.dashboard'),
            'pemilik_kos' => route('pemilik.dashboard'),
            'admin' => route('admin.dashboard'),
            default => route('home'),
        };
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.'
            ])->withInput();
        }

        if (!in_array($user->role, ['mahasiswa', 'pemilik_kos'])) {
            return back()->withErrors([
                'email' => 'Akun ini tidak diizinkan login dari halaman ini.'
            ])->withInput();
        }

        if (!$user->hasVerifiedEmail()) {
            return back()->withErrors([
                'email' => 'Email Anda belum diverifikasi.'
            ])->withInput();
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah.'
            ])->withInput();
        }

        $remember = $request->boolean('remember');

        Auth::login($user, $remember);

        $request->session()->regenerate();

        if ($user->role === 'mahasiswa') {
            $identitas = $user->identitasMahasiswa;

            if (!$identitas || !$identitas->is_complete) {
                return redirect()->route('mahasiswa.profile.identitas.edit');
            }

            return redirect()->route('mahasiswa.dashboard');
        }

        if ($user->role === 'pemilik_kos') {
            $identitas = $user->identitasPemilik;

            // belum isi identitas sama sekali
            if (!$identitas || !$identitas->is_complete) {
                return redirect()->route('pemilik.profile.identitas.create');
            }

            // sudah isi identitas tapi belum approved
            if ($identitas->verification_status !== 'approved') {
                return redirect()->route('pemilik.identitas.show');
            }

            // kalau sudah approved baru boleh ke dashboard
            return redirect()->route('pemilik.dashboard');
        }

        Auth::logout();

        return redirect()->route('login')->withErrors([
            'email' => 'Role akun tidak dikenali.'
        ]);
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'regex:/^[a-z0-9_]+$/',
                'unique:users,name',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'policy_accepted_at' => [
                'accepted',
            ],
        ], [
            'name.required' => 'Username wajib diisi.',
            'name.min' => 'Username minimal 3 karakter.',
            'name.max' => 'Username maksimal 30 karakter.',
            'name.regex' => 'Username hanya boleh huruf kecil, angka, dan underscore (_).',
            'name.unique' => 'Username sudah digunakan.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',

            'policy_accepted_at.accepted' => 'Anda harus menyetujui Syarat & Ketentuan serta Kebijakan Privasi.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
            'policy_accepted_at' => now(),
        ]);

        $user->sendEmailVerificationNotification();

        return redirect()
            ->route('mahasiswa.login')
            ->with('success', 'Link verifikasi telah dikirim ke email Anda. Silakan cek email untuk mengaktifkan akun.');
    }

    public function registerProcessPemilik(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'regex:/^[a-z0-9_]+$/',
                'unique:users,name',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'policy_accepted_at' => [
                'accepted',
            ],
        ], [
            'name.required' => 'Username wajib diisi.',
            'name.min' => 'Username minimal 3 karakter.',
            'name.max' => 'Username maksimal 30 karakter.',
            'name.regex' => 'Username hanya boleh huruf kecil, angka, dan underscore (_).',
            'name.unique' => 'Username sudah digunakan.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',

            'policy_accepted_at.accepted' => 'Anda harus menyetujui Syarat & Ketentuan serta Kebijakan Privasi.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'pemilik_kos',
            'policy_accepted_at' => now(),
        ]);

        $user->sendEmailVerificationNotification();

        return redirect()
            ->route('pemilik.login')
            ->with('success', 'Link verifikasi telah dikirim ke email Anda. Silakan cek email untuk mengaktifkan akun pemilik kos.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('mahasiswa.login')
            ->with('success', 'Selamat, berhasil logout.');
    }
}
