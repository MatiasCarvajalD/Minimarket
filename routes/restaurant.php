<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::middleware(['auth'])->group(function () {
    // Página principal del restaurant
    Route::get('/restaurant', [ProductoController::class, 'restaurant'])->name('restaurant.index');
});
