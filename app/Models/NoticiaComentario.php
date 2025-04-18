<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NoticiaComentario extends Model
{
    use HasFactory;

    protected $table = 'tbl_noticia_comentario';
    protected $primaryKey = 'id_comentario';

    protected $fillable = [
        'id_noticia',
        'id_usuario',
        'comentario_detalle'
    ];

    public function noticia()
    {
        return $this->belongsTo(Noticia::class, 'id_noticia');
    }

    public function usuario()
    {
        return $this->belongsTo(UsuarioPagina::class, 'id_usuario');
    }

    public function respuestas()
    {
        return $this->hasMany(NoticiaComentarioRespuesta::class, 'id_comentario');
    }

    public function likes()
    {
        return $this->hasMany(NoticiaComentarioLike::class, 'id_comentario');
    }

    public function countLikes()
    {
        return $this->likes()->count();
    }
}
