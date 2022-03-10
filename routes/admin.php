<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home', 302);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('home', Admin\HomeController::class, ['as' => 'admin']);
    Route::resource('angkot', Admin\AngkotController::class, ['as' => 'admin']);
    Route::resource('promo', Admin\PromoController::class, ['as' => 'admin']);
    Route::resource('transaksi', Admin\TransaksiController::class, ['as' => 'admin']);
    Route::resource('trayek', Admin\TrayekController::class, ['as' => 'admin']);

    Route::group(['prefix' => 'akun'], function() {
        Route::resource('driver', Admin\DriverController::class, ['as' => 'admin.akun']);
        Route::resource('user', Admin\UserController::class, ['as' => 'admin.akun']);
    });

    Route::group(['prefix' => 'pengajuan'], function() {
        Route::resource('bonus', Admin\PengajuanBonusController::class, ['as' => 'admin.pengajuan']);
        Route::resource('driver', Admin\PengajuanDriverController::class, ['as' => 'admin.pengajuan']);
    });
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
