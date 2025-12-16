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
    Route::post('/payment', 'submitPayment')->name('payment.submit');
    Route::get('/transaction', 'transaction')->name('userTransaction');
    Route::get('/aboutus', 'about')->name('userAbout');
});

Route::prefix('/vendor')->controller(VendorController::class)->name('vendor.')->group(function () {
    Route::get('/', 'home')->name('vendorHome');
    Route::get('/product', 'product')->name('vendorProduct');
    Route::get('/transaction', 'transaction')->name('vendorTransaction');
    Route::get('/add', 'add')->name('vendorAdd');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Protected Routes (Authenticated users only)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Legacy auth routes (untuk backward compatibility)
Route::prefix('/user/auth')->controller(AuthController::class)->name('auth.')->group(function () {
    Route::get('/register', 'showRegister')->name('register');
    Route::get('/login', 'showLogin')->name('login');
});

// Language switcher route
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

