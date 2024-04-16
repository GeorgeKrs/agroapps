<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ShopController;
use App\Http\Controllers\API\ShopOfferController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));

/**
 * Guest Routes
 */
Route::controller(AuthController::class)
    ->name("auth.")
    ->prefix("auth")
    ->group(function () {
        Route::post('register', 'register')->name('register');
        Route::post('login', 'login')->name('login');
    });

/**
 * Auth Routes
 */
Route::middleware(Authenticate::using('sanctum'))->group(function () {
    Route::controller(ShopController::class)
        ->name("shops.")
        ->prefix("shops")
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::put('{shop}/update', 'update')->name('update');
            Route::delete('{shop}/delete', 'delete')->name('delete');
        });

    Route::controller(ShopOfferController::class)
        ->name("shop-offers.")
        ->prefix("shop-offers")
        ->group(function () {
            Route::post('store', 'store')->name('store');
        });
});


