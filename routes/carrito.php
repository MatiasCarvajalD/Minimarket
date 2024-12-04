<?php

use App\Http\Controllers\CarritoController;

Route::middleware(['auth'])->prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('index');
    Route::post('add/{cod_producto}', [CarritoController::class, 'add'])->name('add');
    Route::get('checkout', [CarritoController::class, 'checkout'])->name('checkout');
    Route::post('checkout/confirm', [CarritoController::class, 'confirmCheckout'])->name('checkout.confirm');
    Route::delete('remove/{id_carrito}', [CarritoController::class, 'remove'])->name('remove');
});
