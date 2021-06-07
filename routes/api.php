<?php

use App\Http\Controllers\API\AuthController;
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
    Route::post('otp', [AuthController::class, 'requestOtp']);
    Route::post('check', [AuthController::class, 'checkUser']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'users'], function() {
        Route::post('{id}/ubah-password', [UserController::class, 'ubahPassword'])->name('api.users.ubahPassword');
    });

    Route::resource('users', UserController::class, ['as' => 'api', 'only' => 'update']);
});
