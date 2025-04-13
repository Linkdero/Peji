<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmpresaDireccion extends Model
{
    use HasFactory;

    protected $table = 'tbl_informacion_empresa_direccion';
    protected $primaryKey = 'id_direccion';
    protected $fillable = ['id_empresa', 'direccion_detalle', 'iframe_mapa'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }
}
