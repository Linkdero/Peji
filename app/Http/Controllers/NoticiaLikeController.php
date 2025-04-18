<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\NoticiaLike;
use Illuminate\Http\Request;

class NoticiaLikeController extends Controller
{
    public function toggleLike(Request $request, Noticia $noticia)
    {
        $request->validate([
            'id_usuario' => 'required|exists:tbl_usuarios_pagina,id_usuario'
        ]);

        $like = $noticia->likes()->where('id_usuario', $request->id_usuario)->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Like removido', 'liked' => false]);
        }

        $noticia->likes()->create(['id_usuario' => $request->id_usuario]);
        return response()->json(['message' => 'Noticia liked', 'liked' => true]);
    }

    public function checkLike(Request $request, Noticia $noticia)
    {
        $request->validate([
            'id_usuario' => 'required|exists:tbl_usuarios_pagina,id_usuario'
        ]);

        $liked = $noticia->likes()->where('id_usuario', $request->id_usuario)->exists();
        return response()->json(['liked' => $liked]);
    }
}