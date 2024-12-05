<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('usuarios', [AdminController::class, 'usuariosIndex'])->name('usuarios.index');
    Route::get('usuarios/create', [AdminController::class, 'usuariosCreate'])->name('usuarios.create');
    Route::post('usuarios', [AdminController::class, 'usuariosStore'])->name('usuarios.store');
    Route::get('usuarios/{id}/edit', [AdminController::class, 'usuariosEdit'])->name('usuarios.edit');
    Route::put('usuarios/{id}', [AdminController::class, 'usuariosUpdate'])->name('usuarios.update');
    Route::delete('usuarios/{id}', [AdminController::class, 'usuariosDestroy'])->name('usuarios.destroy');

    Route::get('create', [ProductoController::class, 'create'])->name('create'); // Crear producto
    Route::post('store', [ProductoController::class, 'store'])->name('store'); // Guardar producto
    Route::get('{id}/edit', [ProductoController::class, 'edit'])->name('edit'); // Editar producto
    Route::put('{id}/update', [ProductoController::class, 'update'])->name('update'); // Actualizar producto
    Route::delete('{id}', [ProductoController::class, 'destroy'])->name('destroy'); // Eliminar producto
});
