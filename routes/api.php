<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
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
Route::name('api.')->group(function () {
    Route::prefix('auth')->name('auth.')->middleware('guest')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::get('/activate/{token}', [AuthController::class, 'verifyEmail'])->name('verifyEmail');

        Route::post('/password/forgot', [AuthController::class, 'passwordForgot'])->name('passwordForgot');
        Route::post('/password/reset', [AuthController::class, 'passwordReset'])->name('passwordReset');

    });
    Route::prefix('auth')->name('auth.')->middleware('auth:sanctum')->group(function () {
        Route::any('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
