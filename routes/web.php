<?php

use App\Http\Controllers\Homepage\SadarinHomepageController;
use App\Http\Controllers\Homepage\SadarinLoginController;
use App\Http\Controllers\Dashboard\SadarinAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', [SadarinLoginController::class, 'index'])->name('homepage');

/*
|--------------------------------------------------------------------------
| SADARIN
|--------------------------------------------------------------------------
*/

Route::prefix('sadarin')
    ->name('sadarin.')
    ->group(function () {
    /*
        |--------------------------------------------------------------------------
        | HOMEPAGE
        |--------------------------------------------------------------------------
        */

    Route::get('/home', [SadarinHomepageController::class, 'index'])->name('home');

    /*
        |--------------------------------------------------------------------------
        | LOGIN
        |--------------------------------------------------------------------------
        */

    Route::get('/login', [SadarinHomepageController::class, 'showLogin'])->name('login');

    Route::post('/login/internal', [SadarinLoginController::class, 'login'])->name('login.internal');

    /*
        |--------------------------------------------------------------------------
        | OTP
        |--------------------------------------------------------------------------
        */

    Route::get('/login/otp', [SadarinLoginController::class, 'showOtp'])->name('login.otp');

    Route::post('/login/otp', [SadarinLoginController::class, 'verifyOtp'])->name('login.otp.verify');

    /*
        |--------------------------------------------------------------------------
        | SWITCH ROLE
        |--------------------------------------------------------------------------
        */

    Route::post('/role/switch', [SadarinLoginController::class, 'switchRole'])->name('role.switch');

    /*
        |--------------------------------------------------------------------------
        | LOGOUT
        |--------------------------------------------------------------------------
        */

    Route::post('/logout', [SadarinLoginController::class, 'logout'])->name('logout');

    /*
        |--------------------------------------------------------------------------
        | ADMINISTRATOR
        |--------------------------------------------------------------------------
        */

    Route::prefix('admin')
        ->name('admin.')
        ->middleware([
            'sadarin.auth',
            'sadarin.role:Administrator',
        ])
        ->group(function () {

            Route::get('/dashboard', [
                SadarinAdminController::class,
                'index'
            ])->name('dashboard');
        });

    /*
        |--------------------------------------------------------------------------
        | ARSIPARIS
        |--------------------------------------------------------------------------
        */

    Route::prefix('arsiparis')
        ->name('arsiparis.')
        ->middleware(['sadarin.auth', 'sadarin.role:Arsiparis'])
        ->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard-arsiparis.dashboard');
            })->name('dashboard');
        });

    /*
        |--------------------------------------------------------------------------
        | PENGGUNA INTERNAL
        |--------------------------------------------------------------------------
        */

    Route::middleware(['sadarin.auth', 'sadarin.role:Pengguna Internal'])->group(function () {
        Route::get('/dashboard', function () {
            return view('UserPage.index');
        })->name('dashboard');
    });
    });