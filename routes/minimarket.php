<?php

use App\Http\Controllers\ProductoController;

// Rutas para el minimarket
Route::middleware(['auth'])->prefix('minimarket')->name('minimarket.')->group(function () {
    Route::get('/', [ProductoController::class, 'minimarket'])->name('index');
});
