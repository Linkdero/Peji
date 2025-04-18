<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsuarioPagina extends Model
{
    use HasFactory;

    protected $table = 'tbl_usuarios_pagina';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'usuario_nombre',
        'usuario_correo'
    ];

    public function comentarios()
    {
        return $this->hasMany(NoticiaComentario::class, 'id_usuario');
    }

    public function respuestas()
    {
        return $this->hasMany(NoticiaComentarioRespuesta::class, 'id_usuario');
    }

    public function likesNoticias()
    {
        return $this->hasMany(NoticiaLike::class, 'id_usuario');
    }

    public function likesComentarios()
    {
        return $this->hasMany(NoticiaComentarioLike::class, 'id_usuario');
    }
}
