<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});


Route::controller(PostController::class)->group(function () {
    // Route::post('register', 'register');
    Route::resource('posts', PostController::class);
    // Route::get('posts','index');
    Route::post('create-post', 'store');
    Route::post('post/delete', 'destroy');
});


Route::controller(CommentController::class)->group(function () {
    Route::post('create-comment', 'store');
});

// Route::post('login', [AuthController::class, 'login'])->name('login');


    // Route::resource('posts', PostController::class);

Route::middleware('auth:sanctum')->group(function () {
    // Route::resource('posts', PostController::class);
});
