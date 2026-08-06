<?php

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function ($request) {
            // Use session('locale') if available, otherwise fallback
            // $locale = session('locale', app()->getLocale());
            // return '/' . $locale . '/login';
            return localizedRoute('login');
        });
        $middleware->redirectUsersTo(function ($request) {
            // Use session('locale') if available, otherwise fallback
            // $locale = session('locale', app()->getLocale());
            // return '/' . $locale . '/login';
            return localizedRoute('home');
        });
        $middleware->use([
            // App\Http\Middleware\SetLocale::class,
        ]);
        $middleware->alias([
            'SetLocale' => SetLocale::class,
            'SuperAdmin' => SuperAdmin::class,
        ]);
        $middleware->web([
            // setlocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Illuminate\Http\Exceptions\PostTooLargeException $e, $request) {
            return redirect()->back()->with(['error' => __('adminlte::adminlte.file_limit_server')]);
        });
    })->create();
