<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\ProductoController;

// Grupo de rutas protegidas por 'auth' y un middleware de rol (opcional)
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard de Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Gestión de Usuarios
    Route::get('/admin/usuarios', [AdminUsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::get('/admin/usuarios/{id}/edit', [AdminUsuarioController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/admin/usuarios/{id}', [AdminUsuarioController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('/admin/usuarios/{id}', [AdminUsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');
    
    // Gestión de Productos
    Route::get('/admin/productos', [ProductoController::class, 'index'])->name('admin.productos.index');
    Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/admin/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
    Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
});
