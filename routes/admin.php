<?php

use App\Http\Controllers\Admin\AngkotController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\API\DriverController;
use App\Http\Controllers\API\PromoController;
use App\Http\Controllers\API\TransaksiController;
use App\Http\Controllers\API\TrayekController;
use App\Models\PengajuanBonus;
use App\Models\PengajuanDriver;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home', 302);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('home', HomeController::class, ['as' => 'admin']);
    Route::resource('angkot', AngkotController::class, ['as' => 'admin']);
    Route::resource('promo', PromoController::class, ['as' => 'admin']);
    Route::resource('transaksi', TransaksiController::class, ['as' => 'admin']);
    Route::resource('trayek', TrayekController::class, ['as' => 'admin']);

    Route::group(['prefix' => 'akun'], function() {
        Route::resource('driver', DriverController::class, ['as' => 'admin.akun']);
        Route::resource('user', UserController::class, ['as' => 'admin.akun']);
    });

    Route::group(['prefix' => 'pengajuan'], function() {
        Route::resource('bonus', PengajuanBonus::class, ['as' => 'admin.pengajuan']);
        Route::resource('driver', PengajuanDriver::class, ['as' => 'admin.pengajuan']);
    });
});

require __DIR__.'/auth.php';
