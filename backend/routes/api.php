<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;

use App\Http\Controllers\API\UserController;



Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::controller(PostController::class)->group(function () {
        // Route::post('register', 'register');
        // Route::get('posts','index');
        Route::resource('posts', PostController::class);
        Route::post('create-post', 'store');
        Route::post('post/delete', 'destroy');
    });
    Route::controller(UserController::class)->group(function () {
        // Route::post('register', 'register');
        // Route::get('posts','index');
        Route::resource('users', UserController::class);
        // Route::post('create-post', 'store');
        // Route::post('post/delete', 'destroy');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::resource('comments', CommentController::class);
        Route::post('create-comment', 'store');
        Route::post('update-comment', 'update');
        Route::post('comment/delete', 'destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::post('create-user', 'store');
    });
});
