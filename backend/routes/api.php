<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\PostController;

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

    Route::resource('posts', PostController::class);

Route::middleware('auth:sanctum')->group(function () {
    // Route::resource('posts', PostController::class);
});