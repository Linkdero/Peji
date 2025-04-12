<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', ['component' => 'Home']);
})->name('home');

Route::get('/about', function () {
    return Inertia::render('Welcome', ['component' => 'About']);
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Welcome', ['component' => 'Contact']);
})->name('contact');
require __DIR__ . '/dashboard.php';
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
require __DIR__ . '/apisCategoria/apiCategoria.php';
require __DIR__ . '/apisNoticia/apiNoticia.php';
require __DIR__ . '/apisModulo/apisModulo.php';
require __DIR__ . '/apisTag/apiTag.php';