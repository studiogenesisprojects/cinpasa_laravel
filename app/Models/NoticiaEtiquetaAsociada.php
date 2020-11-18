<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaEtiquetaAsociada extends Model
{
    protected $table = 'noticias_etiquetas_asociadas';
    protected $fillable = [
        'noticia_id', 'etiqueta_id',
    ];
}
