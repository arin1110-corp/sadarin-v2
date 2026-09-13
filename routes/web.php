<?php

use App\Http\Controllers\Homepage\SadarinHomepageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('sadarin.login');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::prefix('sadarin')->name('sadarin.')->group(function () {
    Route::get('/login', [SadarinHomepageController::class, 'showLogin'])->name('login');

    Route::post('/login/internal', [SadarinHomepageController::class, 'loginInternal'])->name('login.internal');

    Route::post('/login/public', [SadarinHomepageController::class, 'loginPublic'])->name('login.public');

    Route::post('/logout', [SadarinHomepageController::class, 'logout'])->name('logout');
});