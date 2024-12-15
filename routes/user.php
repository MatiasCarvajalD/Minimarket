<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DireccionController;


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
    Route::put('profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('historial-compras', [UserController::class, 'historialCompras'])->name('historial_compras');
    Route::get('detalle-compra/{rut_usuario}', [UserController::class, 'detalleCompra'])->name('detalle_compra');
    Route::get('/direccion/{id}/edit', [DireccionController::class, 'edit'])->name('direccion.edit');
    Route::put('/direccion/{id}', [DireccionController::class, 'update'])->name('direccion.update');
    Route::get('/direccion/create', [DireccionController::class, 'create'])->name('direccion.create');
    Route::post('/direccion/store', [DireccionController::class, 'store'])->name('direccion.store');
    Route::delete('/direccion/{id}', [DireccionController::class, 'destroy'])->name('direccion.destroy');

});
