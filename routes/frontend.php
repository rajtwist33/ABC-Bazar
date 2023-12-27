<?php

use App\Http\Controllers\Frontend\ProductdetailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Frontend\SearchController;


//Clear Cache
Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return redirect('/');
    });


Route::get('/', function () {
    return view('frontend.pages.home');
})->name('home');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::resource('search',SearchController::class);
Route::resource('product-detail',ProductdetailController::class);

