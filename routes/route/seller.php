<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\AccountPropertyController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

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
            $leads = DB::table('re_consults as consults')
                ->join('re_properties as property', 'consults.property_id', '=', 'property.id')
                ->where('consults.created_at', '>=', now()->subDays(4))
                ->where('property.author_id', auth('account')->user()->id)
                ->groupBy(DB::raw('DATE(consults.created_at)'))
                ->select(DB::raw('DATE(consults.created_at) as date'), DB::raw('COUNT(consults.id) as lead_count'))
                ->orderByDesc(DB::raw('DATE(consults.created_at)'))
                ->get();
            $properties = Property::where('author_id', auth('account')->user()->id)->orderBy('views', 'desc')->limit(4)->get();

            $propertyStatusData = DB::table('re_properties as properties')
                ->where('properties.author_id', auth('account')->user()->id)
                ->select(DB::raw('
                                        SUM(CASE WHEN status = "sold" THEN 1 ELSE 0 END) as sold,
                                        SUM(CASE WHEN status = "rented" THEN 1 ELSE 0 END) as rented,
                                        SUM(CASE WHEN status = "renting" THEN 1 ELSE 0 END) as renting,
                                        SUM(CASE WHEN status = "selling" THEN 1 ELSE 0 END) as selling,
                                        SUM(CASE WHEN moderation_status = "pending" THEN 1 ELSE 0 END) as pending
                                    '))
                ->first();


            $mostVisitedProperties = DB::table('re_properties as properties')
                ->select('properties.id', 'properties.name', 'properties.views')
                ->orderByDesc('properties.views')  // Order by the views column
                ->limit(5)
                ->get();

            return view('seller.index', compact('properties', 'leads', 'propertyStatusData', 'mostVisitedProperties'));
        })->name('user.dashboard');
        Route::resource('properties', AccountPropertyController::class)->names('user.properties');
        Route::get('/settings', function () {
            return view('seller.settings.profile');
        })->name('user.settings');

        Route::get('profile', [ProfileController::class, 'index'])->name('user.profile');
        Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('user.profile.update');
        Route::post('profile/update-password', [ProfileController::class, 'changePassword'])->name('user.profile.changePassword');
    });
});

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
