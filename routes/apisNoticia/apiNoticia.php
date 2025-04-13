<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;

// Rutas API Públicas
Route::name('apiNoticia.')->prefix('apiNoticia')->group(function () {
    // Obtener categorías activas
    Route::get('noticias/getNoticiasActivas', [NoticiaController::class, 'getNoticiasActivas'])
        ->name('noticias.activas');

    Route::post('noticias/setNuevaNoticia', [NoticiaController::class, 'store'])
        ->name('noticias.activas');
});
