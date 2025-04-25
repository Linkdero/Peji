<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'tbl_banner';
    protected $primaryKey = 'id_banner';
    protected $fillable = ['banner', 'id_estado'];
    // Ocultar estos campos en las respuestas JSON
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Get the estado associated with the banner.
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado')
            ->select(['id_estado', 'estado_detalle']); // Solo seleccionar estos campos
    }
}
