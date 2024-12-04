<?php

use App\Http\Controllers\ProductoController;

// Rutas para el restaurante
Route::middleware(['auth'])->prefix('restaurant')->name('restaurant.')->group(function () {
    Route::get('/', [ProductoController::class, 'restaurant'])->name('index');
});
