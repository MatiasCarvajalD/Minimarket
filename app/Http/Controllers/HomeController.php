<?php

use App\Http\Controllers\ProductoController;

Route::get('/', [ProductoController::class, 'index'])->name('home');
