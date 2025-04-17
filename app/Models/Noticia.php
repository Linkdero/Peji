<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = 'tbl_noticia';
    protected $primaryKey = 'id_noticia';

    protected $fillable = [
        'noticia_titulo',
        'noticia_detalle',
        'miniatura',
        'id_categoria',
        'id_usuario_creador',
        'id_estado'
    ];
    protected $dates = [
        'fecha_creacion',
        'created_at',
        'updated_at'
    ];

    // Relación con el usuario creador
    public function creador()
    {
        return $this->belongsTo(User::class, 'id_usuario_creador');
    }

    // Accesor para la URL de la miniatura
    public function getMiniaturaUrlAttribute()
    {
        if ($this->miniatura) {
            return asset('storage/noticias/' . $this->miniatura);
        }
        return asset('images/default-noticia.jpg');
    }

    // Relación con el estado
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }


    // Relación con el estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tbl_noticia_detalle_tag', 'id_noticia', 'id_tag')
            ->withTimestamps();
    }

    public function galeriaImagenes()
    {
        return $this->hasMany(NoticiaDetalleGaleria::class, 'id_noticia');
    }
}
