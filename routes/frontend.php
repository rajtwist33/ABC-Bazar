<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\OTP\PhoneAuthController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SendEnquiryController;
use App\Http\Controllers\Frontend\ProductdetailController;

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

// OTP Verification

Route::get('phone-auth', [PhoneAuthController::class, 'index'])->name('phone_otp');
Route::post('phone-auth', [PhoneAuthController::class, 'store'])->name('phone_otp_store');

Route::resource('search',SearchController::class);
Route::resource('product-detail',ProductdetailController::class);
Route::resource('send-enquiry',SendEnquiryController::class);

