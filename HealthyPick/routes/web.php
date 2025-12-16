<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Default Redirect
|--------------------------------------------------------------------------
*/
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
/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Vendor login routes (session-based vendor auth)
Route::get('/login/vendor', [AuthController::class, 'showVendorLogin'])->name('vendor.login');
Route::post('/login/vendor', [AuthController::class, 'vendorLogin'])->name('vendor.login.submit');

/*
|--------------------------------------------------------------------------
| Debug Route (Remove after testing)
|--------------------------------------------------------------------------
*/
Route::get('/test-login', [AuthController::class, 'testLogin']);

/*
|--------------------------------------------------------------------------
| User Routes (Auth Required)
|--------------------------------------------------------------------------
*/
Route::prefix('user')
    ->middleware('auth')
    ->controller(UserController::class)
    ->name('user.')
    ->group(function () {
        Route::get('/', 'home')->name('userHome');
        Route::get('/product', [ProductController::class, 'index'])->name('userProduct');
        Route::get('/vendor', 'vendor')->name('userVendor');
        Route::get('/payment', 'payment')->name('userPayment');
        Route::get('/transaction', 'transaction')->name('userTransaction');
        Route::get('/aboutus', 'about')->name('userAbout');
    });

/*
|--------------------------------------------------------------------------
| Vendor Routes (Auth Required)
|--------------------------------------------------------------------------
*/
Route::prefix('vendor')
    ->middleware(\App\Http\Middleware\VendorAuthenticate::class)
    ->controller(VendorController::class)
    ->name('vendor.')
    ->group(function () {
        Route::get('/', 'home')->name('vendorHome');
        Route::get('/product', 'product')->name('vendorProduct');
        Route::get('/transaction', 'transaction')->name('vendorTransaction');
    });

/*
|--------------------------------------------------------------------------
| Logout (Auth Required)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Vendor logout (clear vendor session)
Route::post('/vendor/logout', [AuthController::class, 'vendorLogout'])->name('vendor.logout');

// Language switcher route
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Legacy Auth Routes (Backward Compatibility)
|--------------------------------------------------------------------------
*/
Route::prefix('user/auth')
    ->controller(AuthController::class)
    ->name('auth.')
    ->group(function () {
        Route::get('/register', 'showRegister')->name('register');
        Route::get('/login', 'showLogin')->name('login');
    });
