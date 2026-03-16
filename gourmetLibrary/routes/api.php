<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('books/search', [BookController::class, 'search']);
Route::get('books/latest', [BookController::class, 'latest']);
Route::get('books/popular', [BookController::class, 'popular']);

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('books', BookController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn (Request $request) => $request->user());

    Route::middleware('admin')->group(function () {
        Route::get('admin/categories/stats', [CategoryController::class, 'stats']);
        Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
        Route::apiResource('books', BookController::class)->except(['index', 'show']);

        Route::get('admin/books/damaged', [BookController::class, 'damagedBooks']);
    });
});