<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dia extends Model
{
    use HasFactory;

    protected $table = 'tbl_dia';
    protected $primaryKey = 'id_dia';
    protected $fillable = ['dia_detalle'];

    public function horarios()
    {
        return $this->hasMany(EmpresaHorario::class, 'id_dia');
    }
}
