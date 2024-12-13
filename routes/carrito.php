<?php

use App\Http\Controllers\CarritoController;

Route::prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('index'); // carrito.index
    Route::get('checkout', [CarritoController::class, 'checkout'])->name('checkout'); // carrito.checkout
    Route::get('confirm', [CarritoController::class, 'confirm'])->name('confirm'); // carrito.confirm
    Route::post('checkout/confirm', [CarritoController::class, 'confirmCheckout'])->name('confirmCheckout'); // carrito.confirmCheckout
    Route::post('add/{cod_producto}', [CarritoController::class, 'add'])->name('add'); // carrito.add
    Route::delete('remove/{id_carrito}', [CarritoController::class, 'remove'])->name('remove'); // carrito.remove
    Route::put('updateQuantity/{id_carrito}', [CarritoController::class, 'updateQuantity'])->name('updateQuantity');

});
