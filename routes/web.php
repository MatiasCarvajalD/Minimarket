<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

Route::get('/', [ProductoController::class, 'index'])->name('home');

Route::resource('productos', ProductoController::class);
Route::resource('ventas', VentaController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
