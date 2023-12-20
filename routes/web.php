<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\Admin\Slider;

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
    Route::resource('dashboard',DashboardController::class);
        Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'admin.'], function () {
            Route::resources([
                'category'=>CategoryController::class,
                'slider'=>SliderController::class,
            ]);
    });
    //Category
    Route::get('trashed/category',[CategoryController::class,'trashed'])->name('admin.category.trashed');
    Route::get('trashed/category/delete/{id}',[CategoryController::class,'forceDelete']);
    Route::get('trashed/category/restore/{id}',[CategoryController::class,'restore']);
    //Slider
    Route::get('slider/delete/{id}',[SliderController::class,'forceDelete']);
});

require __DIR__.'/auth.php';
