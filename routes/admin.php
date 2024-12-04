<?php

use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Productos
    Route::resource('productos', AdminController::class)->except(['show']);

    // Usuarios
    Route::resource('usuarios', AdminController::class)->only(['index', 'edit', 'update']);

    // Ventas
    Route::get('ventas', [AdminController::class, 'ventasIndex'])->name('ventas.index');
    Route::get('ventas/{id}', [AdminController::class, 'ventasShow'])->name('ventas.show');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('reporte', [AdminController::class, 'reporte'])->name('reporte');
});
