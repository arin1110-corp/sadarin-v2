<?php

use App\Http\Controllers\Homepage\SadarinHomepageController;
use App\Http\Controllers\Homepage\SadarinLoginController;
use App\Http\Controllers\Dashboard\SadarinAdminController;
use App\Http\Controllers\Master\SadarinUnitController;
use App\Http\Controllers\Master\SadarinProgramController;
use App\Http\Controllers\Master\SadarinKegiatanController;
use App\Http\Controllers\Master\SadarinSubKegiatanController;
use App\Http\Controllers\Master\SadarinDocumentTypeController;
use App\Http\Controllers\Master\SadarinTagController;
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
        ->middleware(['sadarin.auth', 'sadarin.role:Administrator'])
        ->group(function () {
            Route::get('/dashboard', [SadarinAdminController::class, 'index'])->name('dashboard.index');

            /*
            |--------------------------------------------------------------------------
            | MASTER UNIT
            |--------------------------------------------------------------------------
            */

            Route::prefix('master/unit')
                ->name('master.unit.')
                ->middleware(['sadarin.auth', 'sadarin.role:Administrator'])
                ->group(function () {
                    Route::get('/', [SadarinUnitController::class, 'index'])->name('index');

                    Route::get('/create', [SadarinUnitController::class, 'create'])->name('create');

                    Route::post('/', [SadarinUnitController::class, 'store'])->name('store');

                    Route::get('/{id}/edit', [SadarinUnitController::class, 'edit'])->name('edit');

                    Route::put('/{id}', [SadarinUnitController::class, 'update'])->name('update');

                    Route::delete('/{id}', [SadarinUnitController::class, 'destroy'])->name('destroy');
                });

            /*
            |--------------------------------------------------------------------------
            | MASTER PROGRAM
            |--------------------------------------------------------------------------
            */
            Route::prefix('master/program')
                ->name('master.program.')
                ->middleware(['sadarin.auth', 'sadarin.role:Administrator'])
                ->group(function () {
                    Route::get('/', [SadarinProgramController::class, 'index'])->name('index');

                    Route::get('/create', [SadarinProgramController::class, 'create'])->name('create');

                    Route::post('/', [SadarinProgramController::class, 'store'])->name('store');

                    Route::get('/{id}/edit', [SadarinProgramController::class, 'edit'])->name('edit');

                    Route::put('/{id}', [SadarinProgramController::class, 'update'])->name('update');

                    Route::delete('/{id}', [SadarinProgramController::class, 'destroy'])->name('destroy');
                });

            /*
            |--------------------------------------------------------------------------
            | MASTER KEGIATAN
            |--------------------------------------------------------------------------
            */
            Route::prefix('master/kegiatan')
                ->name('master.kegiatan.')
                ->middleware(['sadarin.auth', 'sadarin.role:Administrator'])
                ->group(function () {
                    Route::get('/', [SadarinKegiatanController::class, 'index'])->name('index');

                    Route::get('/create', [SadarinKegiatanController::class, 'create'])->name('create');

                    Route::post('/', [SadarinKegiatanController::class, 'store'])->name('store');

                    Route::get('/{id}/edit', [SadarinKegiatanController::class, 'edit'])->name('edit');

                    Route::put('/{id}', [SadarinKegiatanController::class, 'update'])->name('update');

                    Route::delete('/{id}', [SadarinKegiatanController::class, 'destroy'])->name('destroy');
                });

            /*
            |--------------------------------------------------------------------------
            | MASTER SUB KEGIATAN
            |--------------------------------------------------------------------------
            */
            Route::prefix('master/sub-kegiatan')
                ->name('master.sub-kegiatan.')
                ->middleware(['sadarin.auth', 'sadarin.role:Administrator'])
                ->group(function () {
                    Route::get('/', [SadarinSubKegiatanController::class, 'index'])->name('index');

                    Route::get('/create', [SadarinSubKegiatanController::class, 'create'])->name('create');

                    Route::post('/', [SadarinSubKegiatanController::class, 'store'])->name('store');

                    Route::get('/{id}/edit', [SadarinSubKegiatanController::class, 'edit'])->name('edit');

                    Route::put('/{id}', [SadarinSubKegiatanController::class, 'update'])->name('update');

                    Route::delete('/{id}', [SadarinSubKegiatanController::class, 'destroy'])->name('destroy');
                });

            /*
            |--------------------------------------------------------------------------
            | MASTER JENIS DOKUMEN
            |--------------------------------------------------------------------------
            */
            Route::prefix('master/document-type')
                ->name('master.document-type.')
                ->middleware(['sadarin.auth', 'sadarin.role:Administrator'])
                ->group(function () {
                    Route::get('/', [SadarinDocumentTypeController::class, 'index'])->name('index');

                    Route::get('/create', [SadarinDocumentTypeController::class, 'create'])->name('create');

                    Route::post('/', [SadarinDocumentTypeController::class, 'store'])->name('store');

                    Route::get('/{id}/edit', [SadarinDocumentTypeController::class, 'edit'])->name('edit');

                    Route::put('/{id}', [SadarinDocumentTypeController::class, 'update'])->name('update');

                    Route::delete('/{id}', [SadarinDocumentTypeController::class, 'destroy'])->name('destroy');
                });

            /*
            |--------------------------------------------------------------------------
            | MASTER TAG
            |--------------------------------------------------------------------------
            */

            Route::prefix('master/tag')
                ->name('master.tag.')
                ->middleware(['sadarin.auth', 'sadarin.role:Administrator'])
                ->group(function () {
            Route::get('/', [SadarinTagController::class, 'index'])->name('index');

            Route::get('/create', [SadarinTagController::class, 'create'])->name('create');

            Route::post('/', [SadarinTagController::class, 'store'])->name('store');

            Route::get('/{id}/edit', [SadarinTagController::class, 'edit'])->name('edit');

            Route::put('/{id}', [SadarinTagController::class, 'update'])->name('update');

                    Route::delete('/{id}', [SadarinTagController::class, 'destroy'])->name('destroy');
                });
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

/*
|--------------------------------------------------------------------------
| MASTER UNIT
|--------------------------------------------------------------------------
*/