<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home', 302);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resources([
        'home' => Admin\HomeController::class,
        'angkot' => Admin\AngkotController::class,
        'transaksi' => Admin\TransaksiController::class,
        'trayek' => Admin\TrayekController::class
    ], [
        'as' => 'admin'
    ]);

    Route::group(['prefix' => 'akun'], function () {
        Route::resources([
            'driver' => Admin\DriverController::class,
            'user' => Admin\UserController::class
        ], [
            'as' => 'admin.akun'
        ]);
    });

    Route::resource('pengajuan/driver', Admin\PengajuanDriverController::class, ['as' => 'admin.pengajuan']);
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
