<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\{LoginController};
use App\Http\Controllers\Frontend\AccountPropertyController;


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

Route::prefix('account')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('/login', [LoginController::class, 'login'])->name('user.login.submit');
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('user.register');
    Route::post('/register', [LoginController::class, 'register'])->name('user.register.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');
    Route::get('/forget-password', [LoginController::class, 'showLoginForm'])->name('user.forget-password');

    Route::middleware(['auth:account'])->group(function () {
        Route::get('/dashboard', function () {
            return view('seller.index');
        })->name('user.dashboard');

        Route::resource('properties', AccountPropertyController::class)->names('user.properties');



        Route::get('/settings', function () {
            return view('seller.settings.profile');
        })->name('user.settings');

    });
    
});