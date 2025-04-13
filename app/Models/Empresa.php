<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'tbl_informacion_empresa';
    protected $primaryKey = 'id_empresa';
    protected $fillable = ['empresa_nombre', 'empresa_detalle', 'empresa_logo'];

    public function telefonos()
    {
        return $this->hasMany(EmpresaTelefono::class, 'id_empresa');
    }

    public function direcciones()
    {
        return $this->hasMany(EmpresaDireccion::class, 'id_empresa');
    }

    public function correos()
    {
        return $this->hasMany(EmpresaCorreo::class, 'id_empresa');
    }

    public function horarios()
    {
        return $this->hasMany(EmpresaHorario::class, 'id_empresa');
    }

    public function redesSociales()
    {
        return $this->hasMany(EmpresaRedSocial::class, 'id_empresa');
    }
}
