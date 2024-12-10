<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;

// Rutas públicas para invitados
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('catalogo', [GuestController::class, 'catalogo'])->name('catalogo');  // Mostrar productos
    Route::get('checkout', [GuestController::class, 'checkout'])->name('checkout');  // Checkout
    Route::post('checkout/confirm', [GuestController::class, 'confirmCheckout'])->name('checkout.confirm');  // Confirmación del checkout
});

// Rutas para usuarios autenticados
Route::middleware(['auth','role:usuario'])->prefix('user')->name('user.')->group(function () {
    Route::get('home', [UserController::class, 'home'])->name('home');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('historial-compras', [UserController::class, 'historialCompras'])->name('historial_compras');
    Route::get('detalle-compra/{id}', [UserController::class, 'detalleCompra'])->name('detalle_compra');
});
