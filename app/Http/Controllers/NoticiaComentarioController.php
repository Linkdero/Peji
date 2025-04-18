<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\NoticiaComentario;
use Illuminate\Http\Request;
use App\Models\UsuarioPagina;
use Illuminate\Support\Facades\Validator;

class NoticiaComentarioController extends Controller
{
    public function getComentariosNoticia(Noticia $noticia)
    {
        return response()->json([
            'comentarios' => $noticia->comentarios()->with('usuario', 'respuestas.usuario', 'likes')->get(),
            'total_comentarios' => $noticia->countComentarios()
        ]);
    }

    public function store(Request $request, Noticia $noticia)
    {
        $request->validate([
            'id_usuario' => 'required|exists:tbl_usuarios_pagina,id_usuario',
            'comentario_detalle' => 'required|string|max:1000'
        ]);

        $comentario = $noticia->comentarios()->create([
            'id_usuario' => $request->id_usuario,
            'comentario_detalle' => $request->comentario_detalle
        ]);

        return response()->json([
            'message' => 'Comentario creado exitosamente',
            'comentario' => $comentario->load('usuario')
        ], 201);
    }

    public function destroy(NoticiaComentario $comentario)
    {
        $comentario->delete();
        return response()->json(['message' => 'Comentario eliminado']);
    }

    public function setNuevoComentario(Request $request, Noticia $noticia)
    {
        $validator = Validator::make($request->all(), [
            'usuario_correo' => 'required|email',
            'usuario_nombre' => 'required|string|max:100',
            'comentario_detalle' => 'required|string|max:1000',
            'id_usuario' => 'sometimes|integer|exists:tbl_usuarios_pagina,id_usuario'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $nuevoUsuario = false;

            if ($request->has('id_usuario')) {
                $usuario = UsuarioPagina::where('id_usuario', $request->id_usuario)
                    ->where('usuario_correo', $request->usuario_correo)
                    ->first();

                if (!$usuario) {
                    return response()->json([
                        'success' => false,
                        'message' => 'El ID de usuario no coincide con el correo proporcionado'
                    ], 400);
                }
            } else {
                $usuario = UsuarioPagina::where('usuario_correo', $request->usuario_correo)->first();
                $nuevoUsuario = !$usuario;

                if ($nuevoUsuario) {
                    $usuario = UsuarioPagina::create([
                        'usuario_nombre' => $request->usuario_nombre,
                        'usuario_correo' => $request->usuario_correo
                    ]);
                }
            }

            // Aquí se guarda el comentario asociado a la noticia
            $comentario = $noticia->comentarios()->create([
                'id_usuario' => $usuario->id_usuario,
                'comentario_detalle' => $request->comentario_detalle
            ]);

            $respuesta = [
                'success' => true,
                'message' => 'Comentario generado exitosamente',
                'comentario' => $comentario,
                'nuevoUsuario' => $nuevoUsuario
            ];

            // Solo se incluye la info del usuario si no está logueado
            if (!$request->has('id_usuario')) {
                $respuesta['usuario'] = [
                    'id_usuario' => $usuario->id_usuario,
                    'usuario_nombre' => $usuario->usuario_nombre,
                    'usuario_correo' => $usuario->usuario_correo
                ];
            }

            return response()->json($respuesta, 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el comentario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
