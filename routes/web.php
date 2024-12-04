<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

require base_path('routes/auth.php');
require base_path('routes/user.php');
require base_path('routes/admin.php');
require base_path('routes/minimarket.php');
require base_path('routes/restaurant.php');
require base_path('routes/guest.php');