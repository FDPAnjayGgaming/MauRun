<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
            
            // 1. Alias Middleware Admin yang sudah kita buat tadi
            $middleware->alias([
                'is_admin' => \App\Http\Middleware\IsAdmin::class,
            ]);

            // 2. TAMBAHKAN INI: Memperbaiki arah lemparan jika user menekan tombol Back
            $middleware->redirectUsersTo(function () {
                // Cek role user yang sedang aktif
                if (Auth::check() && Auth::user()->role === 'admin') {
                    return '/dashboard-panitia';
                }
                
                // Jika peserta, kembalikan ke events
                return '/events';
            });

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
