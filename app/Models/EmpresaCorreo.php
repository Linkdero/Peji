<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmpresaCorreo extends Model
{
    use HasFactory;

    protected $table = 'tbl_informacion_empresa_correo';
    protected $primaryKey = 'id_correo';
    protected $fillable = ['id_empresa', 'correo_detalle'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }
}
