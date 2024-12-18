<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AjusteController;


Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/get-csv', [AdminController::class, 'generateCsv'])->name('download.csv');

    // Gestión de Usuarios
    Route::prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/', [AdminController::class, 'usuarios'])->name('index'); // Listar usuarios
        Route::get('create', [AdminController::class, 'crearUsuario'])->name('create'); // Crear usuario
        Route::post('/', [AdminController::class, 'guardarUsuario'])->name('store'); // Guardar usuario
        Route::get('{rut_usuario}/edit', [AdminController::class, 'editarUsuario'])->name('edit'); // Editar usuario
        Route::put('{rut_usuario}', [AdminController::class, 'actualizarUsuario'])->name('update'); // Actualizar usuario
        Route::delete('{rut_usuario}', [AdminController::class, 'usuariosDestroy'])->name('destroy'); // Eliminar usuario
        Route::patch('{rut_usuario}/restore', [AdminController::class, 'usuariosRestore'])->name('restore');

    });

    // Gestión de Productos
    Route::prefix('productos')->name('productos.')->group(function () {
        Route::get('/', [AdminProductoController::class, 'index'])->name('index'); // Listar productos
        Route::get('create', [AdminProductoController::class, 'create'])->name('create'); // Crear producto
        Route::post('/', [AdminProductoController::class, 'store'])->name('store'); // Guardar producto
        Route::get('{cod_producto}/edit', [AdminProductoController::class, 'edit'])->name('edit'); // Editar producto
        Route::put('{cod_producto}', [AdminProductoController::class, 'update'])->name('update'); // Actualizar producto
        Route::delete('{cod_producto}', [AdminProductoController::class, 'destroy'])->name('destroy'); // Eliminar producto
        Route::patch('{cod_producto}/restore', [AdminProductoController::class, 'restoreProducto'])->name('productos.restore');
        Route::delete('{cod_producto}/force', [AdminProductoController::class, 'forceDeleteProducto'])->name('productos.forceDelete');

    });

    // Gestión de Ventas
    Route::prefix('ventas')->name('ventas.')->group(function () {
        Route::get('/', [VentaController::class, 'index'])->name('index'); // Listar ventas
        Route::get('{id_venta}', [VentaController::class, 'show'])->name('show'); // Detalles de venta
        Route::patch('{id_venta}/estado', [VentaController::class, 'cambiarEstado'])->name('cambiarEstado'); // Cambiar estado
    });
    // Gestión de Proveedores
    Route::prefix('proveedores')->name('proveedores.')->group(function () {
        Route::get('/', [AdminController::class, 'indexProveedores'])->name('index'); // Listar proveedores
        Route::get('crear', [AdminController::class, 'crearProveedor'])->name('crear'); // Mostrar formulario
        Route::post('/', [AdminController::class, 'guardarProveedor'])->name('guardar'); // Guardar proveedor
        Route::get('{id_proveedor}/edit', [AdminController::class, 'editProveedor'])->name('edit');
        Route::put('{id_proveedor}', [AdminController::class, 'updateProveedor'])->name('update');
        Route::delete('{id_proveedor}', [AdminController::class, 'destroyProveedor'])->name('destroy');
        Route::patch('{id_proveedor}/restore', [AdminController::class, 'restoreProveedor'])->name('restore');

    });

    // Gestión de Compras
    Route::prefix('compras')->name('compras.')->group(function () {
        Route::get('/', [AdminController::class, 'indexCompras'])->name('index'); // Listar compras
        Route::get('crear', [AdminController::class, 'crearCompra'])->name('crear'); // Mostrar formulario
        Route::post('/', [AdminController::class, 'guardarCompra'])->name('guardar'); // Guardar compra
        Route::get('{cod_compra}', [AdminController::class, 'showCompra'])->name('show'); // Mostrar detalles de una compra
    });

    Route::prefix('ajustes')->name('ajustes.')->group(function () {
        Route::get('/', [AjusteController::class, 'index'])->name('index'); // Listar ajustes
        Route::get('crear', [AjusteController::class, 'create'])->name('create'); // Crear ajuste
        Route::post('/', [AjusteController::class, 'store'])->name('store'); // Guardar ajuste
    });


    
    
});

