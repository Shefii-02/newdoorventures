<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Frontend\FrontendController;


Route::get('/', [FrontendController::class, 'index'])->name('public.index');
Route::get('properties', [FrontendController::class, 'properties'])->name('public.properties');
Route::get('projects', [FrontendController::class, 'projects'])->name('public.projects');
Route::get('projects/{uid}/{slug}', [FrontendController::class, 'projectDetails'])->name('public.project_single');
Route::get('properties/{uid}/{slug}', [FrontendController::class, 'propertyDetails'])->name('public.property_single');
Route::get('contact', [FrontendController::class, 'contact'])->name('public.contact');
Route::get('news', [FrontendController::class, 'blogList'])->name('public.news');
Route::get('news/{slug}', [FrontendController::class, 'blogDetails'])->name('public.blog_single');

Route::post('searching-in-keywords', [FrontendController::class, 'searchingInKeywords'])->name('searching-in-keywords');
Route::post('newsletter/subscribe', [FrontendController::class, 'blogDetails'])->name('newsletter.subscribe');
Route::post('send/consultants', [FrontendController::class, 'blogDetails'])->name('public.send.consult');
Route::get('{slug}', [FrontendController::class, 'page'])->name('public.page');
