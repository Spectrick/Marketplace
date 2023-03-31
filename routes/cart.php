<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::group(['middleware' => 'auth'], function () {
    Route::get('cart', [CartController::class, 'cart'])->name('cart');
    Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('update-cart', [CartController::class, 'update'])->name('cart.update');
    Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
});
