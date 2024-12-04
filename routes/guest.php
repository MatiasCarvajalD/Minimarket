<?php

use App\Http\Controllers\GuestController;

// Rutas para invitados
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('catalogo', [GuestController::class, 'catalogo'])->name('catalogo');
    Route::get('producto/{id}', [GuestController::class, 'detalleProducto'])->name('producto.detalle');
    Route::get('checkout', [GuestController::class, 'checkout'])->name('checkout');
});
