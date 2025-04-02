<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tbl_tag';
    protected $primaryKey = 'id_tag';
    protected $fillable = [
        'tag_detalle',
        'id_estado'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }
}
