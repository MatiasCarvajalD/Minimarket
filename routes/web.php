<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\RoleMiddleware;

// Ruta de inicio (Landing page)
Route::get('/', function () {
    return view('inicio'); // Cambia esto a tu vista inicial
})->name('home');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    // Rutas para productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    // Rutas para usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/crear', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/editar', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    // Rutas para ventas
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/crear', [VentaController::class, 'create'])->name('ventas.create');
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/{id}/detalle', [VentaController::class, 'show'])->name('ventas.show');
});

// Ruta para el carrito de compras (accesible para todos)
Route::get('/carrito', function () {
    return view('carrito.index');
})->name('carrito.index');



Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
});

