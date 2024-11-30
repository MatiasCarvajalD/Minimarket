<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UserController;

// Rutas para usuarios autenticados
Route::middleware('auth')->group(function () {
    // Perfil del usuario
    Route::get('/perfil', [UserController::class, 'perfil'])->name('user.perfil');

    // Carrito de compras
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
    Route::delete('/carrito/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');

    Route::get('/pedidos', [UserController::class, 'pedidos'])->name('user.pedidos');
    
    Route::delete('/carrito/remove/{id_carrito}', [CarritoController::class, 'remove'])->name('carrito.remove');
});
