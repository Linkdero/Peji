<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

// Rutas API Públicas
Route::name('apiTag.')->prefix('apiTag')->group(function () {
    // Obtener tags activos
    Route::get('tags/getTagsActivos', [TagController::class, 'getTagsActivos'])
        ->name('tags.activos');
});
