<?php

namespace App\Http\Controllers;

use App\Models\NoticiaComentario;
use App\Models\NoticiaComentarioLike;
use Illuminate\Http\Request;

class NoticiaComentarioLikeController extends Controller
{
    public function toggleLike(Request $request, NoticiaComentario $comentario)
    {
        $request->validate([
            'id_usuario' => 'required|exists:tbl_usuarios_pagina,id_usuario'
        ]);

        $like = $comentario->likes()->where('id_usuario', $request->id_usuario)->first();

        if ($like) {
            $like->delete();
            return response()->json([
                'message' => 'Like removido',
                'liked' => false,
                'total_likes' => $comentario->countLikes()
            ]);
        }

        $comentario->likes()->create(['id_usuario' => $request->id_usuario]);
        return response()->json([
            'message' => 'Comentario liked',
            'liked' => true,
            'total_likes' => $comentario->countLikes()
        ]);
    }

    public function checkLike(Request $request, NoticiaComentario $comentario)
    {
        $request->validate([
            'id_usuario' => 'required|exists:tbl_usuarios_pagina,id_usuario'
        ]);

        $liked = $comentario->likes()->where('id_usuario', $request->id_usuario)->exists();
        return response()->json(['liked' => $liked]);
    }
}
