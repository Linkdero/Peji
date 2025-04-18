<?php

namespace App\Http\Controllers;

use App\Models\NoticiaComentario;
use App\Models\NoticiaComentarioRespuesta;
use Illuminate\Http\Request;

class NoticiaComentarioRespuestaController extends Controller
{
    public function store(Request $request, NoticiaComentario $comentario)
    {
        $request->validate([
            'id_usuario' => 'required|exists:tbl_usuarios_pagina,id_usuario',
            'respuesta_detalle' => 'required|string|max:1000'
        ]);

        $respuesta = $comentario->respuestas()->create([
            'id_usuario' => $request->id_usuario,
            'respuesta_detalle' => $request->respuesta_detalle
        ]);

        return response()->json([
            'message' => 'Respuesta creada exitosamente',
            'respuesta' => $respuesta->load('usuario')
        ], 201);
    }

    public function destroy(NoticiaComentarioRespuesta $respuesta)
    {
        $respuesta->delete();
        return response()->json(['message' => 'Respuesta eliminada']);
    }
}