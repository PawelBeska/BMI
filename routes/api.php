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
    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/bmi', [\App\Http\Controllers\Api\BmiController::class, 'addToHistory'])->name('history.addToHistory');
        Route::post('/historia', [\App\Http\Controllers\Api\BmiController::class, 'getHistoryData'])->name('history.getData');

        Route::delete('/historia/{bmi}', [\App\Http\Controllers\Api\BmiController::class, 'destroy'])->name('history.destroy');
    });
});
