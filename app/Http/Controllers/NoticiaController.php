<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::with('creador')
            ->orderBy('fecha_creacion', 'desc')
            ->paginate(10);

        return response()->json($noticias);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'noticia_titulo' => 'required|string|max:255',
            'noticia_detalle' => 'required|string',
            'miniatura' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_usuario_creador' => 'required|exists:users,id',
            'id_estado' => 'required|exists:tbl_estado,id_estado'
        ]);

        // Manejo de la imagen
        if ($request->hasFile('miniatura')) {
            $path = $request->file('miniatura')->store('public/noticias');
            $validated['miniatura'] = basename($path);
        }

        $noticia = Noticia::create($validated);

        return response()->json($noticia, 201);
    }

    public function show(Noticia $noticia)
    {
        return response()->json($noticia->load('creador'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $validated = $request->validate([
            'noticia_titulo' => 'sometimes|string|max:255',
            'noticia_detalle' => 'sometimes|string',
            'miniatura' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_estado' => 'sometimes|exists:tbl_estado,id_estado'
        ]);

        // Manejo de la imagen
        if ($request->hasFile('miniatura')) {
            // Eliminar imagen anterior si existe
            if ($noticia->miniatura) {
                Storage::delete('public/noticias/' . $noticia->miniatura);
            }

            $path = $request->file('miniatura')->store('public/noticias');
            $validated['miniatura'] = basename($path);
        }

        $noticia->update($validated);

        return response()->json($noticia);
    }

    public function destroy(Noticia $noticia)
    {
        // Eliminar imagen asociada si existe
        if ($noticia->miniatura) {
            Storage::delete('public/noticias/' . $noticia->miniatura);
        }

        $noticia->delete();

        return response()->json(null, 204);
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
