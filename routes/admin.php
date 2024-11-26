<?php
// routes/admin.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\VentaController;

// Gestión de usuarios y administración
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
});
