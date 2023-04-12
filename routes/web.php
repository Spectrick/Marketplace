<?php

use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\UserController;

Route::view('/','home.index')->name('home');

Route::middleware('guest')->group(function()
{
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function()
{
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
});

    Route::post('currency/change', [CurrencyController::class, 'change'])->name('currency.change')->middleware('setCurrency');
