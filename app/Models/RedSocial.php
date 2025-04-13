<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RedSocial extends Model
{
    use HasFactory;

    protected $table = 'tbl_red_social';
    protected $primaryKey = 'id_red_social';
    protected $fillable = ['red_social_detalle'];

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class, 'tbl_informacion_empresa_red_social', 'id_red_social', 'id_empresa')
            ->withPivot('link');
    }}
