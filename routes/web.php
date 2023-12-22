<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;

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
    return view('auth.login');
})->name('home');
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
                'product'=>ProductController::class,
                'setting'=>SettingController::class,
            ]);
            Route::post('productcode',[ProductController::class,'productcode'])->name('productcode');
    });


    //Category
    Route::get('trashed/category',[CategoryController::class,'trashed'])->name('admin.category.trashed');
    Route::get('trashed/category/delete/{id}',[CategoryController::class,'forceDelete']);
    Route::get('trashed/category/restore/{id}',[CategoryController::class,'restore']);

    //Setting
    Route::get('trashed/setting',[SettingController::class,'trashed'])->name('admin.setting.trashed');
    Route::get('trashed/setting/delete/{id}',[SettingController::class,'forceDelete']);
    Route::get('trashed/setting/restore/{id}',[SettingController::class,'restore']);

    //Slider
    Route::get('slider/delete/{id}',[SliderController::class,'forceDelete']);

    //Product
    Route::get('trashed/product',[ProductController::class,'trashed'])->name('admin.product.trashed');
    Route::get('trashed/product/delete/{id}',[ProductController::class,'forceDelete']);
    Route::get('trashed/product/restore/{id}',[ProductController::class,'restore']);

    //delete product image
    Route::delete('delete/product/{id}/image',[ProductController::class,'delete_product_image'])->name('admin.delete_product_image');
    Route::delete('delete/imperfectionimage/{id}/image',[ProductController::class,'imperfectionimage'])->name('admin.imperfectionimage');

    // Profile
    Route::get('profile',[ProfileController::class,'edit'])->name('profile');
    Route::post('profile/update',[ProfileController::class,'update'])->name('profile.update');
//Password Controller
Route::get('password/change', [PasswordController::class,'showChangePasswordForm'])->name('admin.password.change');
Route::post('password/update', [PasswordController::class,'updatePassword'])->name('admin.password.update');
});

require __DIR__.'/auth.php';
