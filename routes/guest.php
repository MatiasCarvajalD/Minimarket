<?php

use App\Http\Controllers\GuestController;



// Rutas para invitados
Route::middleware('web')->prefix('guest')->name('guest.')->group(function () {
    Route::get('home', [GuestController::class, 'home'])->name('home'); // Página principal
    Route::get('catalogo', [GuestController::class, 'catalogo'])->name('catalogo'); // Catálogo
    Route::get('producto/{id}', [GuestController::class, 'detalleProducto'])->name('producto.detalle'); // Detalle del producto
    
    // Checkout
    Route::get('checkout', [GuestController::class, 'checkout'])->name('checkout'); // Vista del checkout
    Route::post('checkout', [GuestController::class, 'confirmCheckout'])->name('checkout.process'); // Proceso del checkout (POST)

    // Confirmación
    Route::get('checkout/confirm', [GuestController::class, 'confirm'])->name('checkout.confirm'); // Vista de confirmación de datos
    Route::get('confirmacion', [GuestController::class, 'confirmacion'])->name('confirmacion'); // Vista final de confirmación
});
