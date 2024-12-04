<?php

use Illuminate\Support\Facades\Route;

// Ver catálogo público
Route::get('/catalogo', function () {
    return view('catalogo');
})->name('guest.catalogo');

// Ver detalles de un producto
Route::get('/producto/{id}', function ($id) {
    return view('producto', ['id' => $id]);
})->name('guest.producto');

