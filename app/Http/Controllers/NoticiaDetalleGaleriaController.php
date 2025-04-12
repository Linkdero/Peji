<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoticiaDetalleGaleria;

class NoticiaDetalleGaleriaController extends Controller
{
    // Listar todas las imágenes de noticias
    public function index()
    {
        return NoticiaDetalleGaleria::all();
    }

    // Crear una nueva imagen para una noticia
    public function store(Request $request)
    {
        $request->validate([
            'id_noticia' => 'required|exists:tbl_noticia,id_noticia',
            'ruta' => 'required|string|max:255',
        ]);

        return NoticiaDetalleGaleria::create($request->all());
    }

    // Mostrar una imagen específica
    public function show($id)
    {
        return NoticiaDetalleGaleria::findOrFail($id);
    }

    // Actualizar una imagen
    public function update(Request $request, $id)
    {
        $galeria = NoticiaDetalleGaleria::findOrFail($id);

        $request->validate([
            'ruta' => 'sometimes|required|string|max:255',
        ]);

        $galeria->update($request->all());

        return response()->json([
            'message' => 'Actualizado correctamente',
            'data' => $galeria
        ]);
    }

    // Eliminar una imagen
    public function destroy($id)
    {
        $galeria = NoticiaDetalleGaleria::findOrFail($id);
        $galeria->delete();

        return response()->json(['message' => 'Imagen eliminada correctamente']);
    }
}
