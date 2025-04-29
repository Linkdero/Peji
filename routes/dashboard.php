<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ModuloController;
use Illuminate\Support\Facades\Schema; // <<--- agregar esto
use Illuminate\Support\Str;

if (Schema::hasTable('tbl_modulo')) { // <<--- proteger con hasTable
    $moduloController = new ModuloController();
    $response = $moduloController->getModulosSubModulosActivos();
    $modulos = json_decode($response->getContent(), true);

    foreach ($modulos as $modulo) {
        if (isset($modulo['sub_modulos'])) {
            foreach ($modulo['sub_modulos'] as $subModulo) {
                $moduloName = str_replace(' ', '', $modulo['modulo_detalle']);
                $subModuloName = str_replace(' ', '', $subModulo['sub_modulo_detalle']);
                $routeName = $moduloName . $subModuloName;

                Route::get('dashboard/' . strtolower($moduloName) . '/' . strtolower($subModuloName), function () use ($subModuloName) {
                    return Inertia::render('Dashboard', ['component' => $subModuloName]);
                })->middleware(['auth', 'verified'])->name($routeName);
            }
        }
    }
}

// Ruta principal dashboard (siempre debe existir)
Route::get('dashboard', function () {
    return Inertia::render('Dashboard', ['component' => 'Principal']);
})->middleware(['auth', 'verified'])->name('dashboard');
