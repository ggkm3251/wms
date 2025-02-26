<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothingItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// LOGIN route
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

// REGISTER route
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');


Route::middleware(['auth:sanctum'])->group(function () {
    // Clothing Items Routes
    Route::apiResource('clothing-items', ClothingItemController::class);

    // Categories Routes
    Route::apiResource('categories', CategoryController::class);
});
