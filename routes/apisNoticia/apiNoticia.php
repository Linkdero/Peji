<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\NoticiaComentarioController;

// Rutas API Públicas
Route::name('apiNoticia.')->prefix('apiNoticia')->group(function () {
    // Obtener categorías activas
    Route::get('noticias/getNoticiasActivas', [NoticiaController::class, 'getNoticiasActivas'])
        ->name('noticias.activas');

    Route::post('noticias/setNuevaNoticia', [NoticiaController::class, 'store'])
        ->name('noticias.nuevas');

    Route::get('noticias/getPrimerasNoticias', [NoticiaController::class, 'getPrimerasNoticias'])
        ->name('noticias.primeras');

    Route::get('noticias/getUltimasNoticias', [NoticiaController::class, 'getUltimasNoticias'])
        ->name('noticias.ultimas');

    Route::get('noticias/getNoticiasFiltradas', [NoticiaController::class, 'getNoticiasFiltradas'])
        ->name('noticias.filtradas');

    Route::post('{noticia}/setNuevoComentario', [NoticiaComentarioController::class, 'setNuevoComentario']);
    Route::get('{noticia}/getComentariosNoticia', [NoticiaComentarioController::class, 'getComentariosNoticia']);
    Route::get('noticias/getNoticiasEstados', [NoticiaController::class, 'getNoticiasEstados'])
        ->name('noticias.estados');
});
