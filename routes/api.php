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

});

/**
 * Guest Routes
 */
