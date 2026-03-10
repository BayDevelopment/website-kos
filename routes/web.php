<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\DashboardPemilikController;
use App\Http\Controllers\IdentitasMahasiswaController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\PemilikProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirect Login Default Laravel
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return redirect()->route('mahasiswa.login');
})->name('login');


/*
|--------------------------------------------------------------------------
| Public / Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $user = Auth::user();

    if ($user) {
        if ($user->role === 'mahasiswa') {
            $identitas = $user->identitasMahasiswa;

            if (!$identitas) {
                return redirect()->route('mahasiswa.profile.identitas.edit');
            }

            if ($identitas->verification_status !== 'approved') {
                return redirect()->route('mahasiswa.profile.identitas.show');
            }

            return redirect()->route('mahasiswa.dashboard');
        }

        if ($user->role === 'pemilik_toko') {
            return redirect()->route('pemilik.dashboard');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
    }

    return view('guest.homepage');
})->name('home');


/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
    Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');

    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');

        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
    });
});


/*
|--------------------------------------------------------------------------
| Authenticated Mahasiswa - identitas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:mahasiswa', 'identitas.mahasiswa'])
    ->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {

        Route::get('/profile/identitas', [IdentitasMahasiswaController::class, 'edit'])
            ->name('profile.identitas.edit');

        Route::post('/profile/identitas', [IdentitasMahasiswaController::class, 'update'])
            ->name('profile.identitas.update');

        Route::get('/profile/identitas/detail', [IdentitasMahasiswaController::class, 'show'])
            ->name('profile.identitas.show');
    });



/*
|--------------------------------------------------------------------------
| Authenticated Mahasiswa - approved only
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'role:mahasiswa',
    'identitas.mahasiswa',
    'identitas.approved'
])->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {

        Route::get('/dashboard', [DashboardMahasiswaController::class, 'index'])
            ->name('dashboard');

        Route::get('/profile/akun', [AccountController::class, 'edit'])
            ->name('profile.akun.edit');

        Route::post('/profile/akun', [AccountController::class, 'update'])
            ->name('profile.akun.update');
    });


/*
|--------------------------------------------------------------------------
| Authenticated Pemilik
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:pemilik_toko'])
    ->prefix('pemilik')
    ->name('pemilik.')
    ->group(function () {

        Route::get('/dashboard', [DashboardPemilikController::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', [PemilikProfileController::class, 'edit'])
            ->name('profile.edit');
    });


/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);

    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Link verifikasi tidak valid.');
    }

    if (! $request->hasValidSignature()) {
        abort(403, 'Link verifikasi sudah tidak valid atau kadaluarsa.');
    }

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return redirect()->route('mahasiswa.login')
        ->with('success', 'Email berhasil diverifikasi. Silakan login.');
})->middleware('signed')->name('verification.verify');


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
