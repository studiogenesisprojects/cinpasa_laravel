<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaEtiquetaLang extends Model
{
    protected $table = 'noticia_etiquetas_lang';
    protected $fillable = [
        'noticia_etiqueta_id', 'idioma_id', 'nombre', 'slug',
    ];

    public function tag(){
        return $this->belongsTo(NoticiaEtiqueta::class, 'noticia_etiqueta_id');
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
