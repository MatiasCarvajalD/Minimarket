<?php

use Illuminate\Support\Facades\Route;

Route::get('/prueba', function () {
    return view('prueba');
})->name('prueba');

// Cargar rutas separadas
require base_path('routes/auth.php');        // Rutas de autenticación
require base_path('routes/admin.php');       // Rutas de administración
require base_path('routes/user.php');        // Rutas para usuarios autenticados
require base_path('routes/guest.php');       // Rutas para invitados
require base_path('routes/carrito.php');     // Rutas del carrito
require base_path('routes/minimarket.php');  // Rutas del minimarket
require base_path('routes/restaurant.php');  // Rutas del restaurante
require base_path('routes/productos.php');   // Ruta Productos

