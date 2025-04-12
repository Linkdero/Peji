<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubModulo extends Model
{
    use HasFactory;

    protected $table = 'tbl_sub_modulo';
    protected $primaryKey = 'id_sub_modulo';

    protected $fillable = [
        'id_modulo',
        'sub_modulo_detalle',
        'activo'
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'id_modulo');
    }
}
