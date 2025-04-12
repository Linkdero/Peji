<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ModuloController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

// Primero genera las rutas dinámicas
$moduloController = new ModuloController();
$response = $moduloController->getModulosSubModulosActivos();
$modulos = json_decode($response->getContent(), true);

foreach ($modulos as $modulo) {
    if (isset($modulo['sub_modulos'])) {
        foreach ($modulo['sub_modulos'] as $subModulo) {
            // Normaliza los nombres para URLs
            $moduloName = str_replace(' ', '', $modulo['modulo_detalle']);
            $subModuloName = str_replace(' ', '', $subModulo['sub_modulo_detalle']);
            $routeName = $moduloName . $subModuloName;

            // Luego define la ruta principal dashboard
            Route::get('dashboard/' . strtolower($moduloName) . '/' . strtolower($subModuloName), function () use ($subModuloName) {
                return Inertia::render('Dashboard', ['component' => $subModuloName]);
            })->middleware(['auth', 'verified'])->name($routeName);
        }
    }
}

// Luego define la ruta principal dashboard
Route::get('dashboard', function () {
    return Inertia::render('Dashboard', ['component' => 'Principal']);
})->middleware(['auth', 'verified'])->name('dashboard');
