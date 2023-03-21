<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CommentController;

Route::prefix('admin')->middleware(['auth', 'admin'])->group (function ()
{
    Route::get('products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('products/{product}', [ProductController::class, 'delete'])->name('admin.products.delete');

    Route::get('products/{product}/comments', [CommentController::class, 'index'])->name('admin.products.comments');
    Route::post('products/{product}/comments', [CommentController::class, 'store'])->name('admin.products.comments.store');
    Route::get('products/{product}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('admin.products.comments.edit');
    Route::put('products/{product}/comments/{comment}', [CommentController::class, 'update'])->name('admin.products.comments.update');
    Route::delete('products/comments/{comment}', [CommentController::class, 'delete'])->name('admin.products.comments.delete');
});
