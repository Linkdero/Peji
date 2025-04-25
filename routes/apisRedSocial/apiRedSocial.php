<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedSocialController;

// Rutas API Públicas
Route::name('apiRedSocial.')->prefix('apiRedSocial')->group(function () {
    // Obtener banners
    Route::get('redSocial/getAllRedesSociales', [RedSocialController::class, 'getAllRedesSociales'])
        ->name('redSocial.todos');
});
