<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NoticiaComentarioLike extends Model
{
    use HasFactory;

    protected $table = 'tbl_noticia_comentario_like';

    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'id_comentario',
        'id_usuario'
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
