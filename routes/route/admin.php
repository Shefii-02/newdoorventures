<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PropertyController;

Route::prefix('admin')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('admin.index');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

Route::group(['middleware' => ['auth:web'],'prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin'], function () {

    Route::resource('dashboard', DashboardController::class)->names('dashboard');

    Route::get('properties/approved', [PropertyController::class, 'approved'])->name('properties.approved');
    Route::get('properties/suspended', [PropertyController::class, 'suspended'])->name('properties.suspended'); 
    Route::get('properties/sold-rented', [PropertyController::class, 'soldRented'])->name('properties.sold-rented');
    Route::resource('properties', PropertyController::class)->names('properties');

    
    Route::resource('projects', ProjectController::class)->names('projects');
    Route::resource('builders', BuilderController::class)->names('builders');
    Route::resource('amenities', AmenitiesController::class)->names('amenities');
    Route::resource('landmark', LandmarksController::class)->names('landmark');
    Route::resource('furnishing', FurnishingController::class)->names('furnishing');
    Route::resource('rules', RulesController::class)->names('rules');
    Route::resource('advertisement', AdvertisementController::class)->names('advertisement');
    Route::resource('custom-fields', MoreDetailsFieldsController::class)->names('custom-fields');
    Route::resource('configration', ConfigrationController::class)->names('configration');
    Route::resource('contact', ContactController::class)->names('contact');
    Route::resource('newsletter', NewslettersController::class)->names('newsletter');
    Route::resource('activity', ActivityLogsController::class)->names('activity');
    Route::resource('blogs', BlogsController::class)->names('blogs');
    Route::resource('consults', ConsultsController::class)->names('consults');
    Route::resource('accounts', AccountsController::class)->names('accounts');
    Route::resource('categories', CategoriesController::class)->names('categories');
    Route::post('consults/update-status/{id}', 'App\Http\Controllers\Admin\ConsultsController@updateStatus')->name('admin.consults.updateStatus');
    Route::post('contact/update-status/{id}', 'App\Http\Controllers\Admin\ConsultsController@updateStatus')->name('admin.consults.updateStatus');
    Route::resource('blogs', BlogPostController::class)->names('blogs');
    Route::resource('blog-category', BlogCategoryController::class)->names('blogs-category');
    Route::resource('trash', TrashController::class)->names('trash');
    
    Route::get('profile', [ProfileController::class,'index'])->name('profile');
    Route::post('profile/update', 'ProfileController@updateProfile')->name('profile.update');
    Route::post('profile/update-password', 'ProfileController@changePassword')->name('profile.changePassword');
    

});
