<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\NoticiaDetalleGaleria;
use App\Models\NoticiaDetalleTag;
use App\Models\Tag;

class NoticiaController extends Controller
{
    public function store(Request $request)
    {
        // Validar los campos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'detalle' => 'required|string',
            'miniatura' => 'required|file|mimes:webp|max:2048',
            'id_categoria' => 'required|exists:tbl_categoria,id_categoria',
            'tags' => 'required|string',
            'tags.*' => 'string', // Aceptar nombres de tags como strings
            'galeria' => 'nullable|array',
            'galeria.*' => 'file|mimes:webp|max:4096',
        ]);

        // Crear la noticia
        $noticia = Noticia::create([
            'noticia_titulo' => $request->titulo,
            'noticia_detalle' => $request->detalle,
            'miniatura' => '',
            'id_categoria' => $request->id_categoria,
            'id_usuario_creador' => Auth::id(),
            'id_estado' => 1,
            'fecha_creacion' => now(),
        ]);

        // Guardar la miniatura
        $nombreMiniatura = 'miniatura-' . $noticia->id_noticia . '.webp';
        $request->file('miniatura')->move(public_path('noticias/miniaturas'), $nombreMiniatura);
        $noticia->update(['miniatura' => $nombreMiniatura]);

        // Guardar los tags si existen
        if ($request->has('tags')) {
            // Decodificar el JSON a un arreglo
            $tags = json_decode($request->tags, true);

            // Asegurarte de que la decodificación fue exitosa antes de intentar insertar
            if (is_array($tags)) {
                foreach ($tags as $tagValue) {
                    $tagValue = trim($tagValue); // Limpiar el valor del tag para evitar espacios adicionales

                    // Si el valor es un número y es mayor a 0, usarlo como ID
                    if (is_numeric($tagValue) && (int)$tagValue > 0) {
                        $tagId = (int)$tagValue;
                    } else {
                        // Si no es un número, crear un nuevo tag con el nombre
                        if (!empty($tagValue)) {
                            $tag = Tag::create(['tag_detalle' => $tagValue, 'id_estado' => 1]);
                            $tagId = $tag->id_tag; // Obtener el ID del tag creado

                            // Verificar que el ID del tag creado sea válido
                            if ($tagId <= 0) {
                                continue; // Saltar al siguiente tag si el ID no es válido
                            }
                        } else {
                            // Si el valor es vacío o no válido, continuar con el siguiente
                            continue;
                        }
                    }

                    // Crear la relación entre la noticia y el tag
                    NoticiaDetalleTag::create([
                        'id_noticia' => $noticia->id_noticia,
                        'id_tag' => $tagId, // Usamos el ID del tag
                    ]);
                }
            }
        }

        // Guardar la galería de fotos
        if ($request->hasFile('galeria')) {
            foreach ($request->file('galeria') as $index => $imagen) {
                $nombreGaleria = 'galeria-' . $noticia->id_noticia . '-' . $index . '.webp';
                $imagen->move(public_path('noticias/galeria'), $nombreGaleria);

                NoticiaDetalleGaleria::create([
                    'id_noticia' => $noticia->id_noticia,
                    'ruta' => $nombreGaleria
                ]);
            }
        }

        return back()->with('success', 'Noticia, galería y tags creados correctamente');
    }
    public function getNoticiasActivas()
    {
        $noticias = Noticia::with(['creador', 'estado'])
            ->where('id_estado', 1) // Estado activo
            ->orderBy('fecha_creacion', 'desc')
            ->paginate(10);

        return response()->json($noticias);
    }
}
