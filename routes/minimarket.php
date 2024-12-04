<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::middleware(['auth'])->group(function () {
    // Página principal del minimarket
    Route::get('/minimarket', [ProductoController::class, 'minimarket'])->name('minimarket.index');
});
