<?php

use App\Http\Controllers\API\ShopController;
use App\Http\Controllers\API\ShopOfferController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));


/**
 * Auth Routes
 */
Route::middleware(Authenticate::using('sanctum'))->group(function () {
//▪ Shop owner registration => Laravel
//▪ Shop owner login => Laravel
//▪ Shop creation
//▪ Shop edit
//▪ Creating an offer for a shop by shop owner

});

/**
 * Guest Routes
 */

Route::controller(ShopController::class)
    ->name("shops.")
    ->prefix("shops")
    ->group(function () {
        Route::post('store', 'store')->name('store');
        Route::put('{shop}/update', 'update')->name('update');
    });

Route::controller(ShopOfferController::class)
    ->name("shop-offers.")
    ->prefix("shop-offers")
    ->group(function () {
        Route::post('store', 'store')->name('store');
    });

