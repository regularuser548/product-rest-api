<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//Route::middleware(['auth:sanctum'])->group(function () {
//    // All products (general listing, details, updates, deletion)
//    Route::apiResource('products', ProductController::class)->only(['index', 'show', 'update', 'destroy']);
//    // Categories CRUD
//    Route::apiResource('categories', CategoryController::class);
//    // Category-specific product creation and listing
//    Route::apiResource('categories.products', ProductController::class)->only(['index', 'store']);
//});

Route::middleware(['auth:sanctum'])->group(function () {
    // General category routes
    Route::apiResource('categories', CategoryController::class);

    // General product routes
    Route::apiResource('products', ProductController::class)->only(['index', 'show', 'update', 'destroy']);

    // Category-scoped product routes
    Route::apiResource('categories.products', CategoryProductController::class)->only(['index', 'store']);

    // Comments nested under products
    //Route::apiResource('products.comments', ProductCommentController::class)->shallow();

});
