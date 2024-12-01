<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;

// Grupo de rutas protegidas por 'auth'
Route::middleware(['auth'])->group(function () {
    // Minimarket
    Route::get('/minimarket', [ProductoController::class, 'minimarket'])->name('minimarket.index');
    
    // Restaurant
    Route::get('/restaurant', [ProductoController::class, 'restaurant'])->name('restaurant.index');
    
    // Detalle del Producto
    Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
    
    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/add/{id}', [CarritoController::class, 'add'])->name('carrito.add');
    Route::delete('/carrito/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');
    
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    // Checkout para invitados (opcional)
    Route::get('/checkout/invitado', [CheckoutController::class, 'invitadoIndex'])->name('checkout.invitado.index');
    Route::post('/checkout/invitado', [CheckoutController::class, 'invitadoStore'])->name('checkout.invitado.store');
});
