<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleryImageLang extends Model
{
    protected $table = 'galeria_imagenes_lang';
    protected $fillable = [
        'galeria_imagen_id', 'idioma_id', 'texto',
    ];

    public function idiomaTexto()
    {
        return $this->belongsTo('App\Models\Language', 'idioma_id');
    }
}
