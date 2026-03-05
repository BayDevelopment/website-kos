<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestHomeController::class, 'index'])->name('home');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
