<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\CommentController;


Route::prefix('products')->group (function ()
{
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/{product}/comments', [CommentController::class, 'index'])->name('products.comments');
    Route::post('/{product}/comments', [CommentController::class, 'store'])->name('products.comments.store');
});
