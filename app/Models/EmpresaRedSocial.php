<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmpresaRedSocial extends Model
{
    use HasFactory;

    protected $table = 'tbl_informacion_empresa_red_social';
    protected $primaryKey = 'id_red';
    protected $fillable = ['id_empresa', 'id_red_social', 'link'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    public function redSocial()
    {
        return $this->belongsTo(RedSocial::class, 'id_red_social');
    }
}
