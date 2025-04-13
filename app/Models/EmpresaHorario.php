<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmpresaHorario extends Model
{
    use HasFactory;

    protected $table = 'tbl_informacion_empresa_horario';
    protected $primaryKey = 'id_horario';
    protected $fillable = ['id_empresa', 'id_dia', 'hora_inicio', 'hora_final'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    public function dia()
    {
        return $this->belongsTo(Dia::class, 'id_dia');
    }
}
