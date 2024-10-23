<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/users')->group(function () {
    Route::post('/create', [UserController::class, 'createuser']);
    Route::get('/viewAll', [UserController::class, 'getUsers']);
    Route::get('/view', [UserController::class, 'getUser']);
    Route::delete('/delete', [UserController::class, 'deleteUser']);
});

Route::prefix('/posts')->group(function () {
Route::post('/create', [PostController::class, 'createPost'])->middleware('auth:sanctum');
    // Route::get('/viewAll', [PostController::class, 'getPosts']);
    // Route::get('/view', [PostController::class, 'getPost']);
    // Route::delete('/delete', [PostController::class, 'deletePost']);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
