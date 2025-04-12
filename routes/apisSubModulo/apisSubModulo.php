<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubModuloController;

// Rutas API Públicas
Route::name('apiModulo.')->prefix('apiModulo')->group(function () {
    // Obtener categorías activas
    Route::get('subModulos/getSubModulosActivos', [SubModuloController::class, 'getSubModulosActivos'])
        ->name('subModulos.activos');
});