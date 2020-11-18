<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloqueImagen extends Model
{
    protected $table = 'bloque_imagenes';
    protected $fillable = [
        'clase', 'imagen', 'pie_foto', 'activo', 'alt'
    ];
}