<?php

use App\Http\Controllers\ProductoController;

// Rutas para el catálogo de productos (usuarios finales)
Route::prefix('productos')->name('productos.')->group(function () {
    Route::get('/', [ProductoController::class, 'index'])->name('index'); // Catálogo
    Route::get('{id}', [ProductoController::class, 'show'])->name('show'); // Detalle de producto
});
