<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmpresaTelefono extends Model
{
    use HasFactory;

    protected $table = 'tbl_informacion_empresa_telefono';
    protected $primaryKey = 'id_telefono';
    protected $fillable = ['id_empresa', 'telefono_detalle'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }
}
