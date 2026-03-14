<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\DashboardPemilikController;
use App\Http\Controllers\IdentitasMahasiswaController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\PemilikIdentitasController;
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

            if (!$identitas || !$identitas->is_complete) {
                return redirect()->route('mahasiswa.profile.identitas.edit');
            }

            if ($identitas->verification_status !== 'approved') {
                return redirect()->route('mahasiswa.profile.identitas.show');
            }

            return redirect()->route('mahasiswa.dashboard');
        }

        if ($user->role === 'pemilik_kos') {
            $identitas = $user->identitasPemilik;

            if (!$identitas || !$identitas->is_complete) {
                return redirect()->route('pemilik.profile.identitas.create');
            }

            if ($identitas->verification_status !== 'approved') {
                return redirect()->route('pemilik.identitas.show');
            }

            return redirect()->route('pemilik.dashboard');
        }

        if ($user->role === 'admin') {
            return redirect()->route('filament.owner.pages.dashboard');
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

    Route::prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');

        Route::get('/register', [AuthController::class, 'registerPemilik'])->name('register');
        Route::post('/register', [AuthController::class, 'registerProcessPemilik'])->name('register.process');
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
| Authenticated Pemilik - identitas flow
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:pemilik_kos', 'pemilik.verification'])
    ->prefix('pemilik')
    ->name('pemilik.')
    ->group(function () {

        Route::get('/profile/identitas', [PemilikIdentitasController::class, 'create'])
            ->name('profile.identitas.create');

        Route::post('/profile/identitas', [PemilikIdentitasController::class, 'store'])
            ->name('profile.identitas.store');

        Route::get('/profile/identitas/detail', [PemilikIdentitasController::class, 'show'])
            ->name('identitas.show');
    });


/*
|--------------------------------------------------------------------------
| Authenticated Pemilik - approved only
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'role:pemilik_kos',
    'pemilik.verification',
    'pemilik.approved'
])->prefix('pemilik')
    ->name('pemilik.')
    ->group(function () {

        Route::get('/dashboard', [DashboardPemilikController::class, 'index'])
            ->name('dashboard');

        Route::get('/kelola-kos', [DashboardPemilikController::class, 'indexKos'])
            ->name('kos.index');

        Route::get('/kelola-kos/create', [DashboardPemilikController::class, 'createKos'])
            ->name('kos.create');

        Route::post('/kelola-kos/create', [DashboardPemilikController::class, 'prosesCreateKos'])
            ->name('kos.insert');

        Route::get('/kelola-kos/{slug}/edit', [DashboardPemilikController::class, 'editKos'])
            ->name('kos.edit');

        Route::put('/kelola-kos/{slug}', [DashboardPemilikController::class, 'prosesEditKos'])
            ->name('kos.update');

        Route::get('/kelola-kos/{slug}/detail', [DashboardPemilikController::class, 'detailKos'])
            ->name('kos.detail');

        Route::delete('/kelola-kos/{slug}/delete', [DashboardPemilikController::class, 'deleteKos'])
            ->name('kos.destroy');

        // FOTO
        Route::post('/{slug}/foto', [DashboardPemilikController::class, 'fotoKos'])
            ->name('kos.foto.index');

        // KAMAR
        Route::get('/{slug}/kamar', [DashboardPemilikController::class, 'createKamar'])
            ->name('kamar.index');

        Route::post('/{slug}', [DashboardPemilikController::class, 'storeKamar'])
            ->name('kamar.store');

        Route::get('/pembayaran/detail', [DashboardPemilikController::class, 'index'])
            ->name('pembayaran.index');

        Route::get('/booking/cek', [DashboardPemilikController::class, 'index'])
            ->name('booking.index');

        // profile
        Route::get('/profile', [DashboardPemilikController::class, 'index'])
            ->name('profil');
    });


/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);

    if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Link verifikasi tidak valid.');
    }

    if (!$request->hasValidSignature()) {
        abort(403, 'Link verifikasi sudah tidak valid atau kadaluarsa.');
    }

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    if ($user->role === 'pemilik_kos') {
        return redirect()->route('pemilik.login')
            ->with('success', 'Email berhasil diverifikasi. Silakan login.');
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
