<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\GuestHomeController;
use App\Http\Controllers\LegalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return redirect()->route('mahasiswa.login');
})->name('login');

Route::middleware(['guest']) // nanti bisa kamu ganti jadi 'guest:web' atau custom
    ->group(function () {

        // Guest pages
        Route::get('/', [GuestHomeController::class, 'index'])->name('home');

        // Auth mahasiswa (masih guest karena belum login)
        Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
            Route::get('/login', [AuthController::class, 'index'])->name('login');
            Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');

            Route::get('/register', [AuthController::class, 'register'])->name('register');
            Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
        });

        // Legal
        Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
        Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');
    });


Route::middleware(['auth'])
    ->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {

        Route::get('/dashboard', [DashboardMahasiswaController::class, 'index'])
            ->name('dashboard');
    });

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
