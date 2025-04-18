<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NoticiaLike extends Model
{
    use HasFactory;

    protected $table = 'tbl_noticia_like';

    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'id_noticia',
        'id_usuario'
    ];

    public function noticia()
    {
        return $this->belongsTo(Noticia::class, 'id_noticia');
    }

    public function usuario()
    {
        return $this->belongsTo(UsuarioPagina::class, 'id_usuario');
    }
}