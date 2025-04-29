<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Noticia;
use Illuminate\Support\Carbon;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return Inertia::render('Welcome', ['component' => 'Home']);
})->name('home');

Route::get('/about', function () {
    return Inertia::render('Welcome', ['component' => 'About']);
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Welcome', ['component' => 'Contact']);
})->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/category', function () {
    return Inertia::render('Welcome', ['component' => 'Category']);
})->name('category');

Route::get('/noticia/{id}', function ($id) {
    $noticia = Noticia::with([
        'creador:id,name',
        'estado:id_estado,estado_detalle',
        'categoria:id_categoria,categoria_detalle',
        'tags:id_tag,tag_detalle',
        'galeriaImagenes:id,id_noticia,ruta',
    ])->withCount([
        'comentarios',
        'likes'
    ])->findOrFail($id);

    // Función para obtener sufijo ordinal
    function ordinalSuffix($number)
    {
        if (!in_array(($number % 100), [11, 12, 13])) {
            switch ($number % 10) {
                case 1:
                    return 'st';
                case 2:
                    return 'nd';
                case 3:
                    return 'rd';
            }
        }
        return 'th';
    }

    // Formatear fecha con sufijo ordinal
    $fecha = Carbon::parse($noticia->fecha_creacion);
    $dia = $fecha->day;
    $sufijo = ordinalSuffix($dia);
    $noticia->fecha_creacion = $fecha->format('M.') . ' ' . $dia . $sufijo . ', ' . $fecha->format('Y');

    // Eliminar campos created_at y updated_at del modelo principal
    unset($noticia->created_at, $noticia->updated_at);

    // Eliminar los campos created_at y updated_at de cada tag->pivot
    $noticia->tags->each(function ($tag) {
        unset($tag->pivot->created_at, $tag->pivot->updated_at);
    });

    return Inertia::render('Welcome', [
        'component' => 'Noticia',
        'noticia' => $noticia
    ]);
})->name('noticia.ver');
require __DIR__ . '/dashboard.php';
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/apisCategoria/apiCategoria.php';
require __DIR__ . '/apisTag/apiTag.php';
require __DIR__ . '/apisNoticia/apiNoticia.php';
require __DIR__ . '/apisModulo/apisModulo.php';
require __DIR__ . '/apisEmpresa/apiEmpresa.php';
require __DIR__ . '/apisBanner/apiBanner.php';
require __DIR__ . '/apisRedSocial/apiRedSocial.php';
