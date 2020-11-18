<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaDocumento extends Model
{
    protected $table = 'noticias_documentos';
    protected $fillable = [
        'nombre_doc', 'identificador_doc', 'noticia_id', 'idioma_id', 'orden',
    ];
}
