<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'tbl_estado';
    protected $primaryKey = 'id_estado';
    protected $fillable = ['estado_detalle'];

    public function categorias()
    {
        return $this->hasMany(Categoria::class, 'id_estado');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'id_estado');
    }

    public function banners()
    {
        return $this->hasMany(Banner::class, 'id_estado');
    }
}
