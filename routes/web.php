<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AdminUsuarioController;

// Rutas de Autenticación
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/invitado', [AuthController::class, 'loginAsGuest'])->name('guest.login');


// Rutas Protegidas por Autenticación
Route::middleware(['auth'])->group(function () {
    // Ruta de inicio para usuarios autenticados
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rutas de Productos
    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductoController::class, 'index'])->name('productos.index');
        Route::get('/create', [ProductoController::class, 'create'])->name('productos.create');
        Route::post('/', [ProductoController::class, 'store'])->name('productos.store');
        Route::get('/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('/{producto}', [ProductoController::class, 'update'])->name('productos.update');
        Route::delete('/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    });

    // Rutas de Carrito
    Route::prefix('carrito')->group(function () {
        Route::get('/', [CarritoController::class, 'index'])->name('carrito.index');
        Route::post('/add', [CarritoController::class, 'add'])->name('carrito.add');
        Route::delete('/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');
        Route::delete('/clear', [CarritoController::class, 'clear'])->name('carrito.clear');
    });

    // Rutas de Ventas
    Route::prefix('ventas')->group(function () {
        Route::get('/', [VentaController::class, 'index'])->name('ventas.index');
        Route::get('/create', [VentaController::class, 'create'])->name('ventas.create');
        Route::post('/', [VentaController::class, 'store'])->name('ventas.store');
        Route::get('/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
        Route::put('/{venta}', [VentaController::class, 'update'])->name('ventas.update');
        Route::delete('/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');
    });

    // Rutas de Administración de Usuarios
    Route::middleware('role:admin')->prefix('admin/usuarios')->group(function () {
        Route::get('/', [AdminUsuarioController::class, 'index'])->name('admin.usuarios.index');
        Route::get('/create', [AdminUsuarioController::class, 'create'])->name('admin.usuarios.create');
        Route::post('/', [AdminUsuarioController::class, 'store'])->name('admin.usuarios.store');
        Route::get('/{usuario}/edit', [AdminUsuarioController::class, 'edit'])->name('admin.usuarios.edit');
        Route::put('/{usuario}', [AdminUsuarioController::class, 'update'])->name('admin.usuarios.update');
        Route::delete('/{usuario}', [AdminUsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');
    });
});
