<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\VentaController;

Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Gestión de Usuarios
    Route::prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/', [AdminController::class, 'usuarios'])->name('index');
        Route::get('create', [AdminController::class, 'usuariosCreate'])->name('create');
        Route::post('/', [AdminController::class, 'usuariosStore'])->name('store');
        Route::get('{rut_usuario}/edit', [AdminController::class, 'actualizarUsuario'])->name('edit');
        Route::put('{rut_usuario}', [AdminController::class, 'usuariosUpdate'])->name('update');
        Route::delete('{rut_usuario}', [AdminController::class, 'usuariosDestroy'])->name('destroy');
    });

    // Gestión de Productos
    Route::prefix('productos')->name('productos.')->group(function () {
        Route::get('/', [AdminProductoController::class, 'index'])->name('index');
        Route::get('create', [AdminProductoController::class, 'create'])->name('create');
        Route::post('store', [AdminProductoController::class, 'store'])->name('store');
        Route::get('{cod_producto}/edit', [AdminProductoController::class, 'edit'])->name('edit');
        Route::put('{cod_producto}/update', [AdminProductoController::class, 'update'])->name('update');
        Route::delete('{cod_producto}', [AdminProductoController::class, 'destroy'])->name('destroy');
    });
    Route::get('ventas', [VentaController::class, 'index'])->name('ventas.index');

});
