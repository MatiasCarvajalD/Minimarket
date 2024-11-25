<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AdminUsuarioController;

// RUTAS PÚBLICAS
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Login
Route::post('/login', [AuthController::class, 'login']); // Procesar Login
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register'); // Registro
Route::post('/register', [AuthController::class, 'register']); // Procesar Registro

// Inicio como Invitado
Route::get('/guest', function () {
    session(['guest' => true]);
    return redirect()->route('home')->with('message', 'Has ingresado como invitado.');
})->name('guest.login');

// RUTAS PARA INVITADOS Y USUARIOS LOGUEADOS
Route::middleware(['guest.auth'])->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index'); // Lista de productos
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index'); // Ver carrito
});

// RUTAS PARA USUARIOS LOGUEADOS
Route::middleware(['auth'])->group(function () {
    Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add'); // Agregar producto al carrito
    Route::post('/carrito/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove'); // Eliminar producto del carrito
    Route::post('/carrito/clear', [CarritoController::class, 'clear'])->name('carrito.clear'); // Vaciar carrito

    Route::get('/perfil', [AuthController::class, 'showProfile'])->name('perfil'); // Perfil del usuario
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Cerrar sesión
});


// RUTAS PARA ADMINISTRADORES
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminUsuarioController::class, 'index'])->name('admin.index'); // Panel de administración
    Route::get('/admin/usuarios', [AdminUsuarioController::class, 'index'])->name('admin.usuarios.index'); // Lista de usuarios
    Route::get('/admin/usuarios/{id}', [AdminUsuarioController::class, 'show'])->name('admin.usuarios.show'); // Detalle de usuario
    Route::post('/admin/usuarios', [AdminUsuarioController::class, 'store'])->name('admin.usuarios.store'); // Crear usuario
    Route::put('/admin/usuarios/{id}', [AdminUsuarioController::class, 'update'])->name('admin.usuarios.update'); // Actualizar usuario
    Route::delete('/admin/usuarios/{id}', [AdminUsuarioController::class, 'destroy'])->name('admin.usuarios.destroy'); // Eliminar usuario
});

