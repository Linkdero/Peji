<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'tbl_categoria';
    protected $primaryKey = 'id_categoria';
    protected $fillable = [
        'categoria_detalle',
        'id_estado'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }

    public function noticias()
    {
        return $this->hasMany(Noticia::class, 'id_categoria');
    }
}
