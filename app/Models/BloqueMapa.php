<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloqueMapa extends Model
{
    protected $table = 'bloque_mapas';
    protected $fillable = [
        'clase', 'direccion', 'latitud', 'longitud', 'imagen_puntero', 'texto_puntero', 'pie_mapa', 'activo', 'ciudad'
    ];
}
