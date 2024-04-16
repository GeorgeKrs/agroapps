<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/**
 * Auth Routes
 */
Route::middleware('auth:sanctum')->group(function () {
//▪ Shop owner registration => Laravel
//▪ Shop owner login => Laravel
//▪ Shop creation
//▪ Shop edit
//▪ Creating an offer for a shop by shop owner

});

/**
 * Guest Routes
 */
