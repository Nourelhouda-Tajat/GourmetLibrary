<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('books/search', [BookController::class, 'search']);
Route::get('books/latest', [BookController::class, 'latest']);
Route::get('books/popular', [BookController::class, 'popular']);

Route::apiResource('categories', CategoryController::class);
Route::apiResource('books', BookController::class);


Route::get('/test', function () {
    return response()->json([
        "message" => "API GourmetLibrary fonctionne"
    ]);
});
