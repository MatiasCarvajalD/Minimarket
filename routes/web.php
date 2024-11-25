<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\HomeController;

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/invitado', [AuthController::class, 'loginAsGuest'])->name('guest.login');

// Rutas protegidas para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rutas del carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
    Route::delete('/carrito/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');
    Route::delete('/carrito/clear', [CarritoController::class, 'clear'])->name('carrito.clear');

    // Rutas de checkout
    Route::get('/checkout', [CarritoController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CarritoController::class, 'procesarCheckout'])->name('checkout.procesar');

    // Historial de compras
    Route::get('/historial', [VentaController::class, 'historial'])->name('ventas.historial');

    // Rutas de productos
    Route::resource('productos', ProductoController::class);

    // Rutas de ventas
    Route::resource('ventas', VentaController::class)->except(['show']);
});

// Rutas de administración (solo para administradores)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('usuarios', AdminUsuarioController::class, [
        'names' => [
            'index' => 'admin.usuarios.index',
            'create' => 'admin.usuarios.create',
            'store' => 'admin.usuarios.store',
            'edit' => 'admin.usuarios.edit',
            'update' => 'admin.usuarios.update',
            'destroy' => 'admin.usuarios.destroy',
        ],
    ]);

    // Gestión de pedidos
    Route::get('/pedidos', [VentaController::class, 'indexPedidos'])->name('admin.pedidos.index');
    Route::put('/pedidos/{id}', [VentaController::class, 'actualizarEstado'])->name('admin.pedidos.update');

    // Gestión de productos
    Route::get('/productos/stock-critico', [ProductoController::class, 'stockCritico'])->name('admin.productos.stockCritico');

    // Ajustes de stock
    Route::get('/ajustes', [ProductoController::class, 'indexAjustes'])->name('admin.ajustes.index');
    Route::post('/ajustes', [ProductoController::class, 'crearAjuste'])->name('admin.ajustes.create');
});

// Ruta raíz redirige al login
Route::get('/', function () {
    return redirect()->route('login');
});
