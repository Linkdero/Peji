<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuloController;

// Rutas API Públicas
Route::name('apiModulo.')->prefix('apiModulo')->group(function () {
    // Obtener categorías activas
    Route::get('modulos/getModulosSubModulosActivos', [ModuloController::class, 'getModulosSubModulosActivos'])
        ->name('modulos.activos');
});