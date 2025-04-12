<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaDetalleGaleria extends Model
{
    protected $table = 'tbl_noticia_detalle_galeria';

    protected $fillable = ['id_noticia', 'ruta'];

    public function noticia()
    {
        return $this->belongsTo(Noticia::class, 'id_noticia');
    }
}
