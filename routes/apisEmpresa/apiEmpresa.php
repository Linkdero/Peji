<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;

// Rutas API Públicas
Route::name('apiEmpresa.')->prefix('apiEmpresa')->group(function () {
    // Obtener categorías activas
    Route::get('empresa/getInformacionEmpresa', [EmpresaController::class, 'getInformacionEmpresa'])
        ->name('empresas.activas');
});
