<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Noticia;
use App\Models\NoticiaDetalleGaleria;
use App\Models\NoticiaDetalleTag;

class NoticiaSeeder extends Seeder
{
    public function run(): void
    {
        // Lista de títulos y descripciones ficticias para diversificar
        $titulos = [
            'Boda de Ensueño',
            'Fiesta Glam',
            'Quinceañera Real',
            'Lanzamiento Elite',
            'Cóctel Ejecutivo',
            'Noche Mágica',
            'Evento Corporativo',
            'Festival de Colores',
            'Decoración Vintage',
            'Celebración Exclusiva'
        ];

        $descripciones = [
            'Una celebración inolvidable con detalles únicos.',
            'La elegancia y la alegría se combinaron en esta fiesta.',
            'Cada detalle fue diseñado para sorprender a los invitados.',
            'Evento empresarial con alto nivel de producción.',
            'Un cóctel con clase y estilo inigualable.',
            'Luces, color y emoción en cada rincón.',
            'Ambiente profesional con un toque moderno.',
            'Creatividad y pasión reflejadas en cada espacio.',
            'Decoración artesanal con esencia romántica.',
            'Una noche para recordar por siempre.'
        ];

        for ($i = 0; $i < 10; $i++) {
            $noticia = Noticia::create([
                'noticia_titulo' => $titulos[$i],
                'noticia_detalle' => $descripciones[$i],
                'miniatura' => 'miniatura-' . ($i + 1) . '.webp',
                'id_usuario_creador' => 1,
                'id_estado' => 1,
                'id_categoria' => rand(1, 5), // Categoría aleatoria
                'fecha_creacion' => now(),
            ]);

            // Crear una imagen de galería
            NoticiaDetalleGaleria::create([
                'id_noticia' => $noticia->id_noticia,
                'ruta' => 'galeria-' . ($i + 1) . '-0.webp',
            ]);

            // Asignar entre 1 y 3 tags aleatorios
            $tags = collect([1, 2, 3, 4])->shuffle()->take(rand(1, 3));
            foreach ($tags as $tagId) {
                NoticiaDetalleTag::create([
                    'id_noticia' => $noticia->id_noticia,
                    'id_tag' => $tagId,
                ]);
            }
        }
    }
}
