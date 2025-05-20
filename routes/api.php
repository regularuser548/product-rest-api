<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductCommentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    // General category routes
    Route::apiResource('categories', CategoryController::class);

    // General product routes
    Route::apiResource('products', ProductController::class)->only(['index', 'show', 'update', 'destroy']);

    // Category-scoped product routes
    Route::apiResource('categories.products', CategoryProductController::class)->only(['index', 'store']);

    // Product-scoped comment routes
    Route::apiResource('products.comments', ProductCommentController::class)->shallow();

});
