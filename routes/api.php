<?php

use App\Http\Controllers\API\AngkotController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Driver\AngkotController as DriverAngkotController;
use App\Http\Controllers\API\Driver\PesananController as DriverPesananController;
use App\Http\Controllers\API\DriverController;
use App\Http\Controllers\API\PesananController;
use App\Http\Controllers\API\TransaksiController;
use App\Http\Controllers\API\TrayekController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::group(['prefix' => 'auth'], function () {
    Route::post('request-otp', [AuthController::class, 'requestOtp']);
    Route::post('check-otp', [AuthController::class, 'checkOtp']);
    Route::post('check', [AuthController::class, 'checkUser']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'driver'], function () {
        Route::get('{id}/status', [DriverController::class, 'statusPengajuan'])->name('api.driver.statusPengajuan');
        Route::get('statistik', [DriverController::class, 'statistik'])->name('api.driver.statistik');
        Route::resource('pesanan', DriverPesananController::class, ['as' => 'api.driver']);
        Route::apiResource('angkot', DriverAngkotController::class, ['as' => 'api.angkot']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::patch('{user}/ubah-password', [UserController::class, 'ubahPassword'])->name('api.user.ubahPassword');
    });

    Route::group(['prefix' => 'angkot'], function () {
        Route::patch('{angkot}/doc', [AngkotController::class, 'updateDoc'])->name('api.angkot.updateDoc');
    });

    Route::resource('driver', DriverController::class, ['as' => 'api', 'only' => ['show', 'store']]);
    Route::resource('user', UserController::class, ['as' => 'api', 'only' => 'update']);
    Route::resource('transaksi', TransaksiController::class, ['as' => 'api']);
    Route::resource('pesanan', PesananController::class, ['as' => 'api']);
    Route::resource('trayek', TrayekController::class, ['as' => 'api', 'only' => ['index', 'show']]);
});
