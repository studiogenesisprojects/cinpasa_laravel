<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaLang extends Model
{
    protected $table = 'noticias_lang';
    protected $fillable = [
        'noticia_id', 'idioma_id', 'titulo', 'subtitulo', 'texto_corto', 'slug', 'active'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($noticiaLang) {
            if (strlen($noticiaLang->titulo) < 5 || $noticiaLang->titulo == null || $noticiaLang->titulo == '') {
                $noticiaLang->active = false;
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function noticia()
    {
        return $this->belongsTo(Noticia::class);
    }
}