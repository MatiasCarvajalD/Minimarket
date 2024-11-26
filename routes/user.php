<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\HomeController;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
    Route::delete('/carrito/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');
    Route::delete('/carrito/clear', [CarritoController::class, 'clear'])->name('carrito.clear');

    // Checkout
    Route::get('/checkout', [CarritoController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CarritoController::class, 'procesarCheckout'])->name('checkout.procesar');

    // Historial de compras
    Route::get('/historial', [VentaController::class, 'historial'])->name('ventas.historial');
});
