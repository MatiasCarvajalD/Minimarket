<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::middleware(['auth'])->get('/protegido', function () {
    return 'Esta página está protegida.';
});



// Página de Login y Registro
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Página principal pública (opcional, si quieres que funcione como página de bienvenida)
Route::get('/', [HomeController::class, 'index'])->name('home');


require base_path('routes/guest.php'); // Rutas para invitados
require base_path('routes/user.php');  // Rutas para usuarios autenticados
require base_path('routes/admin.php'); // Rutas para administración
