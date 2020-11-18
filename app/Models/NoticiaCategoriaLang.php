<?php

namespace App\Models;

use App\TranslatedModel;


class NoticiaCategoriaLang extends TranslatedModel
{

    protected $table = 'noticia_categorias_lang';
    protected $fillable = [
        'noticia_categoria_id', 'idioma_id', 'nombre', 'slug',
    ];

    public function noticiaCategoria(){
        return $this->belongsTo(NoticiaCategoria::class);
    }
}