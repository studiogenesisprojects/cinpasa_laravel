<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaPrincipal extends Model
{
    protected $table = 'noticias_principales';
    protected $fillable = [
        'noticia_id'
    ];
}