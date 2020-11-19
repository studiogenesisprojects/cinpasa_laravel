<?php

namespace App\Models;

use App\Models\NoticiaEtiquetaLang;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;

class NoticiaEtiqueta extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $table = 'noticia_etiquetas';
    protected $languageModel = NoticiaEtiquetaLang::class;
    protected $languageModelForeignKey = "idioma_id";
    protected $fillable = [
        'activo',
    ];
    protected $appends = ['name'];

    public static function noticiaEtiquetaFiltradas($nombre = '', $slug = '')
    {
        $registros = NoticiaEtiqueta::select('noticia_etiquetas.*')->leftJoin('noticia_etiquetas_lang', 'noticia_etiquetas.id', '=', 'noticia_etiquetas_lang.noticia_etiqueta_id');

        if ($nombre != '') {
            $registros = $registros->where('nombre', 'like', '%' . $nombre . '%');
        }

        if ($slug != '') {
            $registros = $registros->where('slug', 'like', '%' . $slug . '%');
        }

        $registros = $registros->groupby('noticia_etiquetas.id', 'noticia_etiquetas.activo', 'noticia_etiquetas.created_at', 'noticia_etiquetas.updated_at')->orderBy('noticia_etiquetas.id', 'DESC')->paginate(25);

        return $registros;
    }

    public function noticiaEtiquetaLang($idioma_id)
    {
        if (empty($this->id)) {
            return new NoticiaEtiquetaLang;
        }

        $noticiaEtiquetaLang = NoticiaEtiquetaLang::where('idioma_id', '=', $idioma_id)->where('nombre', '<>', '')->where('noticia_etiqueta_id', '=', $this->id)->first();

        if ($noticiaEtiquetaLang) {
            return $noticiaEtiquetaLang;
        } else {
            return new NoticiaEtiquetaLang;
        }
    }

    /*
    * Relacion muchos a muchos entre la tabla de etiquetas y noticias
    */
    public function etiquetaNoticias()
    {
        return $this->belongsToMany('App\Models\Noticia', 'noticias_etiquetas_asociadas', 'etiqueta_id', 'noticia_id')->withTimestamps();
    }

    public function noticiaEtiquetaLangs()
    {
        return $this->hasMany('App\Models\NoticiaEtiquetaLang', 'noticia_etiqueta_id');
    }

    // this is a recommended way to declare event handlers
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($etiqueta) { // before delete() method call this
            $etiqueta->noticiaEtiquetaLangs()->delete();
        });
    }

    public function permitirBorrar()
    {
        $errores = array();
        if ($this->etiquetaNoticias->isNotEmpty()) {
            $errores[] = 'No se puede eliminar, tiene noticias asociadas.';
        }
        return $errores;
    }

    public function news()
    {
        return $this->belongsToMany(Noticia::class, 'noticias_etiquetas_asociadas', 'etiqueta_id', 'noticia_id');
    }

    public function getNameAttribute()
    {
        return $this->lang()->nombre;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return NoticiaEtiquetaLang::where('slug', $value)->first()->tag;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? "";
    }
}
