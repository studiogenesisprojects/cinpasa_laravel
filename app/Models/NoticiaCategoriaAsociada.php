<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaCategoriaAsociada extends Model
{
    protected $table = 'noticias_categorias_asociadas';
    protected $fillable = [
        'noticia_id', 'categoria_id',
    ];
}
