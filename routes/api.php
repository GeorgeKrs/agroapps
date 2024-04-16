<?php

use App\Http\Controllers\API\ShopController;
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
    ->group(function () {
        Route::post('shops/store', 'store')->name('store');
        Route::put('shops/{shop}/update', 'update')->name('update');
    });
