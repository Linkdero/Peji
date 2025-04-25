<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;

// Rutas API Públicas
Route::name('apiBanner.')->prefix('apiBanner')->group(function () {
    // Obtener banners
    Route::get('banner/getAllBanners', [BannerController::class, 'getAllBanners'])
        ->name('banner.todos');
    Route::get('banner/getBannersActivos', [BannerController::class, 'getBannersActivos'])
        ->name('banner.activos');

    // Actualizar estado - CORREGIDO (faltaba el {id} en la ruta)
    Route::put('banner/setCambiarEstadoBanner/{id_banner}', [BannerController::class, 'setCambiarEstadoBanner'])
        ->name('banner.cambiarEstado');

    // Eliminar banner - CORREGIDO (debe ser DELETE y con {id})
    Route::delete('banner/setEliminarBanner/{id_banner}', [BannerController::class, 'setEliminarBanner'])
        ->name('banner.eliminarBanner');

    Route::post('banner/setNuevoBanner/', [BannerController::class, 'setNuevoBanner'])
        ->name('banner.nuevo');
});
