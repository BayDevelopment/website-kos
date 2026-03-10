<?php

use App\Http\Middleware\CheckPemilikVerification;
use App\Http\Middleware\EnsureIdentitasApproved;
use App\Http\Middleware\EnsureMahasiswaIdentitasComplete;
use App\Http\Middleware\EnsurePemilikApproved;
use App\Http\Middleware\RedirectIfUserAlreadyLoggedIn;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'identitas.mahasiswa' => EnsureMahasiswaIdentitasComplete::class,
            'pemilik.verification' => CheckPemilikVerification::class,
            'redirect.loggedin' => RedirectIfUserAlreadyLoggedIn::class,
            'identitas.approved' => EnsureIdentitasApproved::class,
            'pemilik.approved' => EnsurePemilikApproved::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
