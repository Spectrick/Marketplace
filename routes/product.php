<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;


Route::prefix('products')->group (function ()
{
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
});
