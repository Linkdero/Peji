<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NoticiaComentarioRespuesta extends Model
{
    use HasFactory;

    protected $table = 'tbl_noticia_comentario_respuesta';
    protected $primaryKey = 'id_respuesta';

    protected $fillable = [
        'id_comentario',
        'id_usuario',
        'respuesta_detalle'
    ];

    public function comentario()
    {
        return $this->belongsTo(NoticiaComentario::class, 'id_comentario');
    }

    public function usuario()
    {
        return $this->belongsTo(UsuarioPagina::class, 'id_usuario');
    }
}
