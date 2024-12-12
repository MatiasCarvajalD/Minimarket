<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;

Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('usuarios', [AdminController::class, 'usuariosIndex'])->name('usuarios.index');
    Route::get('usuarios/create', [AdminController::class, 'usuariosCreate'])->name('usuarios.create');
    Route::post('usuarios', [AdminController::class, 'usuariosStore'])->name('usuarios.store');
    Route::get('usuarios/{rut_usuario}/edit', [AdminController::class, 'usuariosEdit'])->name('usuarios.edit');
    Route::put('usuarios/{rut_usuario}', [AdminController::class, 'usuariosUpdate'])->name('usuarios.update');
    Route::delete('usuarios/{rut_usuario}', [AdminController::class, 'usuariosDestroy'])->name('usuarios.destroy');

    Route::get('create', [ProductoController::class, 'create'])->name('create'); // Crear producto
    Route::post('store', [ProductoController::class, 'store'])->name('store'); // Guardar producto
    Route::get('{cod_producto}/edit', [ProductoController::class, 'edit'])->name('edit'); // Editar producto
    Route::put('{cod_producto}/update', [ProductoController::class, 'update'])->name('update'); // Actualizar producto
    Route::delete('{cod_producto}', [ProductoController::class, 'destroy'])->name('destroy'); // Eliminar producto
});
