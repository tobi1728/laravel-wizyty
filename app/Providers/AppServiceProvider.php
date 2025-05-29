<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }


    public function boot(): void
    {
        Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            $user = Auth::user();
            if ($user->role === 'admin') return redirect('/admin');
            if ($user->role === 'doctor') return redirect('/doctor');
            return redirect('/patient');
        });
    });
    }
}
