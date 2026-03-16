<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('books', BookController::class)->only(['index', 'show']);

Route::get('books/search', [BookController::class, 'search']);
Route::get('books/latest', [BookController::class, 'latest']);
Route::get('books/popular', [BookController::class, 'popular']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
    Route::apiResource('books', BookController::class)->except(['index', 'show']);
    
});

