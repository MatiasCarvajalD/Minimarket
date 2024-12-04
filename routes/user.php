<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Dashboard del usuario
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/add/{id_producto}', [CarritoController::class, 'add'])->name('carrito.add');
    Route::delete('/carrito/remove/{id_carrito}', [CarritoController::class, 'remove'])->name('carrito.remove');
    Route::post('/carrito/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');

    // Perfil del usuario
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
});
