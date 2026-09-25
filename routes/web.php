<?php

use App\Http\Controllers\Homepage\SadarinHomepageController;
use App\Http\Controllers\Homepage\SadarinLoginController;
use App\Http\Controllers\Homepage\SadarinDriveController;
use App\Http\Controllers\Master\SadarinUnitController;
use App\Http\Controllers\Master\SadarinProgramController;
use App\Http\Controllers\Master\SadarinKegiatanController;
use App\Http\Controllers\Master\SadarinSubKegiatanController;
use App\Http\Controllers\Master\SadarinDocumentTypeController;
use App\Http\Controllers\Master\SadarinTagController;
use App\Http\Controllers\Admin\SadarinUserController;
use App\Http\Controllers\Admin\SadarinRoleController;
use App\Http\Controllers\Admin\SadarinPermissionController;
use App\Http\Controllers\Admin\SadarinRolePermissionController;
use App\Http\Controllers\Admin\SadarinAccessLogController;
use App\Http\Controllers\Admin\SadarinSurveyController;
use App\Http\Controllers\Admin\SadarinArchiveController;
use App\Http\Controllers\Admin\SadarinAdminController;
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
        | LOGIN
        |--------------------------------------------------------------------------
        */

    Route::get('/login', [SadarinLoginController::class, 'index'])->name('login');

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
            | PENGELOLAAN MASTER
            |--------------------------------------------------------------------------
            */

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

        /*
                |--------------------------------------------------------------------------
                | PENGELOLAAN PENGGUNA
                |--------------------------------------------------------------------------
                */
        /*
|--------------------------------------------------------------------------
| ADMINISTRASI SISTEM - PENGGUNA
|--------------------------------------------------------------------------
*/

        Route::prefix('pengguna')
            ->name('pengguna.')
            ->middleware(['sadarin.auth', 'sadarin.role:Administrator'])
            ->group(function () {
                Route::get('/', [SadarinUserController::class, 'index'])->name('index');

            Route::get('/{id}/edit', [SadarinUserController::class, 'edit'])->name('edit');

                Route::put('/{id}', [SadarinUserController::class, 'update'])->name('update');
            });

        /*
|--------------------------------------------------------------------------
| ADMINISTRASI SISTEM - ROLE
|--------------------------------------------------------------------------
*/

        Route::prefix('role')
            ->name('role.')
            ->middleware(['sadarin.auth', 'sadarin.role:Administrator'])
            ->group(function () {
                Route::get('/', [SadarinRoleController::class, 'index'])->name('index');

            Route::get('/create', [SadarinRoleController::class, 'create'])->name('create');

            Route::post('/', [SadarinRoleController::class, 'store'])->name('store');

            Route::get('/{id}/edit', [SadarinRoleController::class, 'edit'])->name('edit');

            Route::put('/{id}', [SadarinRoleController::class, 'update'])->name('update');

                Route::delete('/{id}', [SadarinRoleController::class, 'destroy'])->name('destroy');
            });

        /*
|--------------------------------------------------------------------------
| ADMINISTRASI SISTEM - PERMISSION
|--------------------------------------------------------------------------
*/

        Route::prefix('permission')
            ->name('permission.')
            ->middleware(['sadarin.auth', 'sadarin.role:Administrator'])
            ->group(function () {
                Route::get('/', [SadarinPermissionController::class, 'index'])->name('index');

            Route::get('/create', [SadarinPermissionController::class, 'create'])->name('create');

            Route::post('/', [SadarinPermissionController::class, 'store'])->name('store');

            Route::get('/{id}/edit', [SadarinPermissionController::class, 'edit'])->name('edit');

            Route::put('/{id}', [SadarinPermissionController::class, 'update'])->name('update');

                Route::delete('/{id}', [SadarinPermissionController::class, 'destroy'])->name('destroy');
            });

        /*
                |--------------------------------------------------------------------------
                | PENGELOLAAN ROLE & PERMISSION
                |--------------------------------------------------------------------------
                */

        Route::get('/role/{roleId}/permission', [SadarinRolePermissionController::class, 'edit'])->name('role.permission.edit');

        Route::put('/role/{roleId}/permission', [SadarinRolePermissionController::class, 'update'])->name('role.permission.update');

        /*
|--------------------------------------------------------------------------
| ADMINISTRASI SISTEM - ACCESS LOG
|--------------------------------------------------------------------------
*/

        Route::get('/access-log', [SadarinAccessLogController::class, 'index'])->name('access-log.index');

        /*
            |--------------------------------------------------------------------------
            | PENGELOLAAN SURVEY
            |--------------------------------------------------------------------------
            */

        Route::resource('survey', SadarinSurveyController::class)->except(['show']);
        Route::get('/survey/{id}/responses', [SadarinSurveyController::class, 'responses'])->name('survey.responses');

        /*
            |--------------------------------------------------------------------------
            | PENGELOLAAN ARSIP
            |--------------------------------------------------------------------------
            */
        Route::prefix('archive')
            ->name('archive.')
            ->controller(SadarinArchiveController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');

            Route::get('/create', 'create')->name('create');

            Route::post('/', 'store')->name('store');

            /*
        |--------------------------------------------------------------------------
        | AJAX COMBOBOX
        |--------------------------------------------------------------------------
        */

            Route::get('/kegiatan/{programId}', 'getKegiatan')->name('kegiatan');

            Route::get('/sub-kegiatan/{kegiatanId}', 'getSubKegiatan')->name('sub-kegiatan');

            /*
        |--------------------------------------------------------------------------
        | FILE
        |--------------------------------------------------------------------------
        */

            Route::get('/{archive}/file/create', 'fileCreate')->name('file.create');

            Route::post('/{archive}/file', 'fileStore')->name('file.store');

            Route::delete('/{archive}/file/{file}', 'fileDestroy')->name('file.destroy');

            /*
        |--------------------------------------------------------------------------
        | DETAIL
        |--------------------------------------------------------------------------
        */

            Route::get('/{id}', 'show')->name('show');

            Route::get('/{id}/edit', 'edit')->name('edit');

            Route::put('/{id}', 'update')->name('update');

                    Route::delete('/{id}', 'destroy')->name('destroy');
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
    });

/*
        |--------------------------------------------------------------------------
        | PENGGUNA INTERNAL
        |--------------------------------------------------------------------------
        */
Route::middleware(['sadarin.auth', 'sadarin.role:Pengguna Internal'])
    ->prefix('user')
    ->name('sadarin.user.')
    ->group(function () {
    /*
    |--------------------------------------------------------------------------
    | HOMEPAGE
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [SadarinHomepageController::class, 'index'])->name('archive.index');

    /*
    |--------------------------------------------------------------------------
    | SEMUA ARSIP
    |--------------------------------------------------------------------------
    */

    Route::get('/arsip', [SadarinHomepageController::class, 'archives'])->name('archives');

    /*
    |--------------------------------------------------------------------------
    | DETAIL ARSIP
    |--------------------------------------------------------------------------
    */

    Route::get('/arsip/{id}', [SadarinHomepageController::class, 'showArchive'])->name('archive.show');

    Route::get('archive/{archiveId}/files', [SadarinHomepageController::class, 'showArchive'])->name('archive.files');

    Route::get('/archive/{archiveId}/drive/open', [SadarinHomepageControllers::class, 'openDrive'])->name('archive.drive.open');
    });