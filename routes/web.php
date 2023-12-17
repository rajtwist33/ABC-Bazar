<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;


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
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return view('backend.layouts.main');
        })->name('dashboard');
        Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'admin.'], function () {
            Route::resources([

            ]);
        });


});

require __DIR__.'/auth.php';
