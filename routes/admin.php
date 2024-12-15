<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\VentaController;

Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Gestión de Usuarios
    Route::prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/', [AdminController::class, 'usuarios'])->name('index'); // Listar usuarios
        Route::get('create', [AdminController::class, 'crearUsuario'])->name('create'); // Crear usuario
        Route::post('/', [AdminController::class, 'guardarUsuario'])->name('store'); // Guardar usuario
        Route::get('{rut_usuario}/edit', [AdminController::class, 'editarUsuario'])->name('edit'); // Editar usuario
        Route::put('{rut_usuario}', [AdminController::class, 'actualizarUsuario'])->name('update'); // Actualizar usuario
        Route::delete('{rut_usuario}', [AdminController::class, 'usuariosDestroy'])->name('destroy'); // Eliminar usuario
    });

    // Gestión de Productos
    Route::prefix('productos')->name('productos.')->group(function () {
        Route::get('/', [AdminProductoController::class, 'index'])->name('index'); // Listar productos
        Route::get('create', [AdminProductoController::class, 'create'])->name('create'); // Crear producto
        Route::post('/', [AdminProductoController::class, 'store'])->name('store'); // Guardar producto
        Route::get('{cod_producto}/edit', [AdminProductoController::class, 'edit'])->name('edit'); // Editar producto
        Route::put('{cod_producto}', [AdminProductoController::class, 'update'])->name('update'); // Actualizar producto
        Route::delete('{cod_producto}', [AdminProductoController::class, 'destroy'])->name('destroy'); // Eliminar producto
    });

    // Gestión de Ventas
    Route::prefix('ventas')->name('ventas.')->group(function () {
        Route::get('/', [VentaController::class, 'index'])->name('index'); // Listar ventas
        Route::get('{id_venta}', [VentaController::class, 'show'])->name('show'); // Detalles de venta
        Route::patch('{id_venta}/estado', [VentaController::class, 'cambiarEstado'])->name('cambiarEstado'); // Cambiar estado
    });
});

