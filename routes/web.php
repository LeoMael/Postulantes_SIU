<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rutas de Autenticación (Públicas)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas Protegidas (Solo usuarios autenticados)
Route::middleware('auth')->group(function () {
    // Vista principal con la tabla y los filtros
    Route::get('/', [PostulanteController::class, 'index'])->name('postulantes.index');

    // Endpoint AJAX para búsqueda y paginación rápida
    Route::get('/api/postulantes/buscar', [PostulanteController::class, 'buscar'])->name('postulantes.buscar');

    // Exportar postulantes según filtros (Excel o CSV)
    Route::get('/postulantes/exportar', [PostulanteController::class, 'exportar'])->name('postulantes.exportar');

    // Módulo de Administración de Usuarios (Exclusivo Administradores)
    Route::prefix('api/usuarios')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('usuarios.index');
        Route::post('/', [UserController::class, 'store'])->name('usuarios.store');
        Route::put('/{id}/password', [UserController::class, 'updatePassword'])->name('usuarios.password');
        Route::put('/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('usuarios.toggle');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
    });
});
