<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'tbl_modulo';
    protected $primaryKey = 'id_modulo';

    protected $fillable = [
        'modulo_detalle',
        'icon',
        'activo'
    ];

    public function subModulos()
    {
        return $this->hasMany(SubModulo::class, 'id_modulo');
    }
}
