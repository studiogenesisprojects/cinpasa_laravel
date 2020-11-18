<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaRelacionada extends Model
{
    protected $table = 'noticias_relacionadas';
    protected $fillable = [
        'noticia_id', 'idioma_id', 'noticia_relacionada', 'orden',
    ];
}
