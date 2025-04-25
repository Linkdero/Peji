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
use Illuminate\Support\Carbon;

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
            ->where('id_estado', 1)
            ->orderBy('fecha_creacion', 'asc')
            ->get();

        $noticias = $noticias->map(function ($noticia) {
            // Formatear la fecha
            $noticia->fecha_creacion = Carbon::parse($noticia->fecha_creacion)->translatedFormat('M. jS, Y');

            // Eliminar timestamps del modelo principal
            unset($noticia->created_at, $noticia->updated_at);

            // Eliminar datos sensibles del creador
            if ($noticia->creador) {
                unset(
                    $noticia->creador->created_at,
                    $noticia->creador->updated_at,
                    $noticia->creador->email,
                    $noticia->creador->email_verified_at
                );
            }

            // Eliminar timestamps del estado
            if ($noticia->estado) {
                unset($noticia->estado->created_at, $noticia->estado->updated_at);
            }
            if ($noticia->categoria) {
                unset($noticia->categoria->created_at, $noticia->categoria->updated_at);
            }

            return $noticia;
        });

        return response()->json($noticias);
    }

    public function getPrimerasNoticias()
    {
        $noticias = Noticia::with(['creador', 'estado'])
            ->where('id_estado', 1)
            ->orderBy('fecha_creacion', 'asc')
            ->limit(5)
            ->get();

        $noticias = $noticias->map(function ($noticia) {
            // Formatear la fecha
            $noticia->fecha_creacion = Carbon::parse($noticia->fecha_creacion)->translatedFormat('M. jS, Y');

            // Eliminar timestamps del modelo principal
            unset($noticia->created_at, $noticia->updated_at);

            // Eliminar datos sensibles del creador
            if ($noticia->creador) {
                unset(
                    $noticia->creador->created_at,
                    $noticia->creador->updated_at,
                    $noticia->creador->email,
                    $noticia->creador->email_verified_at
                );
            }

            // Eliminar timestamps del estado
            if ($noticia->estado) {
                unset($noticia->estado->created_at, $noticia->estado->updated_at);
            }
            if ($noticia->categoria) {
                unset($noticia->categoria->created_at, $noticia->categoria->updated_at);
            }

            return $noticia;
        });

        return response()->json($noticias);
    }

    public function getUltimasNoticias()
    {
        $noticias = Noticia::with(['creador', 'estado'])
            ->where('id_estado', 1)
            ->orderBy('id_noticia', 'desc')
            ->limit(5)
            ->get();

        $noticias = $noticias->map(function ($noticia) {
            // Formatear la fecha
            $noticia->fecha_creacion = Carbon::parse($noticia->fecha_creacion)->translatedFormat('M. jS, Y');

            // Eliminar timestamps del modelo principal
            unset($noticia->created_at, $noticia->updated_at);

            // Eliminar datos sensibles del creador
            if ($noticia->creador) {
                unset(
                    $noticia->creador->created_at,
                    $noticia->creador->updated_at,
                    $noticia->creador->email,
                    $noticia->creador->email_verified_at
                );
            }

            // Eliminar timestamps del estado
            if ($noticia->estado) {
                unset($noticia->estado->created_at, $noticia->estado->updated_at);
            }

            // Eliminar timestamps del estado
            if ($noticia->categoria) {
                unset($noticia->categoria->created_at, $noticia->categoria->updated_at);
            }

            return $noticia;
        });

        return response()->json($noticias);
    }

    public function getNoticiasFiltradas(Request $request)
    {
        $query = Noticia::with(['creador', 'estado', 'categoria', 'tags'])
            ->where('id_estado', 1);

        // Filtro por categoría
        if ($request->filled('id_categoria')) {
            $query->where('id_categoria', $request->id_categoria);
        }

        // Filtro por tags (pueden ser IDs o nombres)
        if ($request->filled('tags')) {
            $tags = is_string($request->tags) ? json_decode($request->tags, true) : $request->tags;

            $query->whereHas('tags', function ($q) use ($tags) {
                $q->where(function ($subQuery) use ($tags) {
                    foreach ($tags as $tag) {
                        if (is_numeric($tag)) {
                            $subQuery->orWhere('tbl_tag.id_tag', $tag);
                        } else {
                            $subQuery->orWhere('tbl_tag.tag_detalle', 'like', '%' . $tag . '%');
                        }
                    }
                });
            });
        }

        // Ordenar por fecha de creación descendente
        $query->orderBy('fecha_creacion', 'desc');

        // Paginación con 10 elementos por página
        $perPage = $request->input('per_page', 10); // Permite cambiar el número de elementos por página
        $noticias = $query->paginate($perPage);

        // Limpiar y formatear datos
        $noticias->getCollection()->transform(function ($noticia) {
            $noticia->fecha_creacion = Carbon::parse($noticia->fecha_creacion)->translatedFormat('M. jS, Y');

            unset($noticia->created_at, $noticia->updated_at);

            if ($noticia->creador) {
                unset(
                    $noticia->creador->created_at,
                    $noticia->creador->updated_at,
                    $noticia->creador->email,
                    $noticia->creador->email_verified_at
                );
            }

            if ($noticia->estado) {
                unset($noticia->estado->created_at, $noticia->estado->updated_at);
            }

            if ($noticia->categoria) {
                unset($noticia->categoria->created_at, $noticia->categoria->updated_at);
            }

            if ($noticia->tags) {
                foreach ($noticia->tags as $tag) {
                    unset($tag->created_at, $tag->updated_at);

                    if (isset($tag->pivot)) {
                        unset($tag->pivot->created_at, $tag->pivot->updated_at);
                    }
                }
            }

            return $noticia;
        });

        return response()->json($noticias);
    }

    public function getNoticiasEstados(Request $request)
    {
        $estado = $request->input('estado'); // Se espera que sea 0, 1 o 2

        $query = Noticia::with(['creador', 'estado', 'categoria']);

        if ($estado === null || !in_array($estado, [0, 1, 2])) {
            return response()->json(['error' => 'Parámetro estado inválido'], 400);
        }

        // Si el estado es distinto de 2, aplicamos el filtro
        if ($estado != 2) {
            $query->where('id_estado', $estado);
        }

        $noticias = $query->orderBy('fecha_creacion', 'desc')->get();

        // Formatear y limpiar datos
        $noticias = $noticias->map(function ($noticia) {
            $noticia->fecha_creacion = Carbon::parse($noticia->fecha_creacion)->translatedFormat('M. jS, Y');
            unset($noticia->created_at, $noticia->updated_at);

            if ($noticia->creador) {
                unset(
                    $noticia->creador->created_at,
                    $noticia->creador->updated_at,
                    $noticia->creador->email,
                    $noticia->creador->email_verified_at
                );
            }

            if ($noticia->estado) {
                unset($noticia->estado->created_at, $noticia->estado->updated_at);
            }

            if ($noticia->categoria) {
                unset($noticia->categoria->created_at, $noticia->categoria->updated_at);
            }

            return $noticia;
        });

        return response()->json($noticias);
    }
}
