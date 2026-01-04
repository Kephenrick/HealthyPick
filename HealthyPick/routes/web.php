<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return redirect('/user');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});


Route::middleware('guest')->group(function () {
    Route::get('/login/vendor', [AuthController::class, 'showVendorLogin'])->name('vendor.login');
    Route::post('/login/vendor', [AuthController::class, 'vendorLogin'])->name('vendor.login.submit');
});


// Route::get('/test-login', [AuthController::class, 'testLogin']);






Route::prefix('user')
    ->middleware('auth')
    ->name('user.')
    ->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'home')->name('userHome');
            Route::get('/vendor', 'vendor')->name('userVendor');
            Route::get('/payment', 'payment')->name('userPayment');
            Route::post('/payment', 'submitPayment')->name('payment.submit');
            Route::get('/transaction', 'transaction')->name('userTransaction');
            Route::get('/aboutus', 'about')->name('userAbout');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('/product', 'index')->name('userProduct');
            Route::post('/product/{productId}/purchase', 'purchase')->name('product.purchase');
        });
    });







Route::prefix('vendor')
    ->middleware([\App\Http\Middleware\VendorAuthenticate::class])
    ->controller(VendorController::class)
    ->name('vendor.')
    ->group(function () {
        Route::get('/', 'home')->name('vendorHome');
        Route::get('/product', 'product')->name('vendorProduct');
        Route::get('/add', 'add')->name('vendorAdd');
        Route::post('/add', 'store')->name('vendorAdd.store');
        Route::get('/{id}/edit', 'edit')->name('vendorEdit');
        Route::put('/{id}', 'update')->name('vendorUpdate');
        Route::delete('/{id}', 'destroy')->name('vendorDelete');
        Route::get('/transaction', 'transaction')->name('vendorTransaction');
        Route::post('/transaction/{id}/complete', 'completeTransaction')->name('transaction.complete');
        Route::post('/transaction/{id}/cancel', 'cancelTransaction')->name('transaction.cancel');
    });









Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



Route::post('/vendor/logout', [AuthController::class, 'vendorLogout'])
    ->name('vendor.logout');


Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');





Route::prefix('user/auth')
    ->controller(AuthController::class)
    ->name('auth.')
    ->group(function () {
        Route::get('/register', 'showRegister')->name('register');
        Route::get('/login', 'showLogin')->name('login');
    });
