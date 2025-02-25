<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothingItemController;
use App\Http\Controllers\CategoryController;

Route::middleware(['auth:sanctum'])->group(function () {
    // Clothing Items Routes
    Route::apiResource('clothing-items', ClothingItemController::class);

    // Categories Routes
    Route::apiResource('categories', CategoryController::class);
});
