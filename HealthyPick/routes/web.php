<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;

// Route::get('/', function () {
//     return view('user.userHome');
// });

Route::get('/', function () {
    return redirect('/user');
});

Route::prefix('/user')->controller(UserController::class)->name('user.')->group(function () {
    Route::get('/', 'home')->name('userHome');
    Route::get('/product', 'product')->name('userProduct');
    Route::get('/vendor', 'vendor')->name('userVendor');
    Route::get('/payment', 'payment')->name('userPayment');
    Route::get('/transaction', 'transaction')->name('userTransaction');
    Route::get('/aboutus', 'about')->name('userAbout');
});

Route::prefix('/vendor')->controller(VendorController::class)->name('vendor.')->group(function () {
    Route::get('/', 'home')->name('vendorHome');
    Route::get('/product', 'product')->name('vendorProduct');
    Route::get('/transaction', 'transaction')->name('vendorTransaction');
});

Route::prefix('/user/auth')->controller(AuthController::class)->name('auth.')->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::get('/login', 'login')->name('login');
});
