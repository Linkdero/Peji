<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaDetalleTag extends Model
{
    protected $table = 'tbl_noticia_detalle_tag';

    protected $fillable = ['id_noticia', 'id_tag'];

    public function noticia()
    {
        return $this->belongsTo(Noticia::class, 'id_noticia');
    }
}
