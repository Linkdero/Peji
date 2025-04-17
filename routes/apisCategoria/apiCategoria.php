<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

// Rutas API Públicas
Route::name('apiCategoria.')->prefix('apiCategoria')->group(function () {
    // Obtener categorías activas
    Route::get('categorias/getCategoriasActivas', [CategoriaController::class, 'getCategoriasActivas'])
        ->name('categorias.activas');

    Route::get('categorias/getCategoriasConteoNoticias', [CategoriaController::class, 'getCategoriasConteoNoticias'])
        ->name('categorias.conteoNoticias');
});
