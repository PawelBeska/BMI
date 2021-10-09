<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'auth.login')->name('auth.login');
    Route::view('/register', 'auth.register')->name('auth.register');
    Route::view('/forgot_password', 'auth.forgot_password')->name('auth.forgot_password');
    Route::view('/reset_password/{token}', 'auth.reset_password')->name('auth.reset_password');
    Route::view('/verify_email/{token}', 'auth.verify_email')->name('auth.verify_email');
});

Route::middleware(['auth'])->group(function () {
    Route::name('home.')->group(function () {
        Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');

        Route::get('/o-mnie', [\App\Http\Controllers\IndexController::class, 'index'])->name('about.index');

        Route::any('/logout', function () {
            Auth::logout();
            return redirect()->route('home.index');
        })->name('logout');

    });
});
