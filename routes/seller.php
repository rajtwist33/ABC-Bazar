<?php

use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'App\Http\Controllers\Seller', 'as' => 'seller.','prefix' => 'seller'], function () {
    Route::resources([
        'product'=>ProductController::class,
    ]);
    Route::post('productcode',[ProductController::class,'productcode'])->name('productcode');
});
