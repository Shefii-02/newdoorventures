<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\AccountPropertyController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Models\Property;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

Route::prefix('account')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('/login', [LoginController::class, 'login'])->name('user.login.submit');
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('user.register');
    Route::post('/register', [LoginController::class, 'register'])->name('user.register.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');
    Route::get('/forget-password', [LoginController::class, 'showRestForm'])->name('user.forget-password');
    Route::post('/forget-password', [LoginController::class, 'SendRestForm'])->name('user.forget-password.send');
    

    Route::middleware(['auth:account'])->group(function () {
        Route::get('/dashboard', function () {
            $properties = Property::where('author_id',auth('account')->user()->id)->orderBy('views','desc')->limit(4)->get();
            return view('seller.index',compact('properties'));
        })->name('user.dashboard');
        Route::resource('properties', AccountPropertyController::class)->names('user.properties');
        Route::get('/settings', function () {
            return view('seller.settings.profile');
        })->name('user.settings');

        Route::get('profile', [ProfileController::class,'index'])->name('user.profile');
        Route::post('profile/update', [ProfileController::class,'updateProfile'])->name('user.profile.update');
        Route::post('profile/update-password', [ProfileController::class,'changePassword'])->name('user.profile.changePassword');
    });
});

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');