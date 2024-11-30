<?php
// routes/admin.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\VentaController;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('usuarios', AdminUsuarioController::class);
    Route::resource('productos', ProductoController::class)->except(['show']);
    Route::resource('ventas', VentaController::class)->only(['index', 'show']);
    Route::get('/reporte', [AdminController::class, 'reporte'])->name('admin.reporte');
});
