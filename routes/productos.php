<?php

use App\Http\Controllers\ProductoController;

Route::prefix('productos')->name('productos.')->group(function () {
    Route::get('/', [ProductoController::class, 'index'])->name('index');
    Route::get('create', [ProductoController::class, 'create'])->name('create');
    Route::post('store', [ProductoController::class, 'store'])->name('store');
    Route::get('{id}/edit', [ProductoController::class, 'edit'])->name('edit');
    Route::put('{id}/update', [ProductoController::class, 'update'])->name('update');
    Route::delete('{id}', [ProductoController::class, 'destroy'])->name('destroy');
});
