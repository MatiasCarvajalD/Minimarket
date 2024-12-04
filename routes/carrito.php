<?php

use App\Http\Controllers\CarritoController;

Route::middleware(['auth'])->prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('index');
    Route::get('checkout', [CarritoController::class, 'checkout'])->name('checkout');
    Route::delete('remove/{id}', [CarritoController::class, 'remove'])->name('remove');
});
