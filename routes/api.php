<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DriverController;
use App\Http\Controllers\API\FavoritController;
use App\Http\Controllers\API\TransaksiController;
use App\Http\Controllers\API\TrayekController;
use App\Http\Controllers\API\UserController;
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
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('{id}/ubah-password', [UserController::class, 'ubahPassword'])->name('api.user.ubahPassword');
    });

    Route::resource('driver', DriverController::class, ['as' => 'api', 'only' => ['show', 'store']]);
    Route::resource('user', UserController::class, ['as' => 'api', 'only' => 'update']);
    Route::resource('favorit', FavoritController::class, ['as' => 'api']);
    Route::resource('transaksi', TransaksiController::class, ['as' => 'api']);
    Route::resource('trayek', TrayekController::class, ['as' => 'api', 'only' => ['index', 'show']]);
});
