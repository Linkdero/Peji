<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoticiaDetalleTag;

class NoticiaDetalleTagController extends Controller
{
    public function index()
    {
        return NoticiaDetalleTag::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_noticia' => 'required|exists:tbl_noticia,id_noticia',
            'id_tag' => 'required|exists:tbl_tag,id_tag',
        ]);

        return NoticiaDetalleTag::create($request->all());
    }

    public function show($id)
    {
        return NoticiaDetalleTag::findOrFail($id);
    }

    public function destroy($id)
    {
        $registro = NoticiaDetalleTag::findOrFail($id);
        $registro->delete();

        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
