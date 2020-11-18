<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaRedactorLang extends Model
{
    protected $table = 'noticia_redactores_lang';
    protected $fillable = [
        'noticia_redactor_id', 'idioma_id', 'biografia',
    ];
}
