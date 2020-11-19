<?php

namespace App\Models;

use App\Models\NoticiaCategoriaLang;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;

class NoticiaCategoria extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $table = 'noticia_categorias';
    protected $fillable = [
        'activo',
    ];
    protected $languageModel = NoticiaCategoriaLang::class;
    protected $languageModelForeignKey = "idioma_id";
    protected $appends = ['name'];

    public static function noticiaCategoriaFiltradas($nombre = '', $slug = '')
    {
        $registros = NoticiaCategoria::select('noticia_categorias.*')->leftJoin('noticia_categorias_lang', 'noticia_categorias.id', '=', 'noticia_categorias_lang.noticia_categoria_id');

        if ($nombre != '') {
            $registros = $registros->where('nombre', 'like', '%' . $nombre . '%');
        }

        if ($slug != '') {
            $registros = $registros->where('slug', 'like', '%' . $slug . '%');
        }

        $registros = $registros->groupby('noticia_categorias.id', 'noticia_categorias.activo', 'noticia_categorias.created_at', 'noticia_categorias.updated_at')->orderBy('noticia_categorias.id', 'DESC')->paginate(25);

        return $registros;
    }

    public function noticiaCategoriaLang($idioma_id)
    {
        if (empty($this->id)) {
            return new NoticiaCategoriaLang;
        }

        $noticiaCategoriaLang = NoticiaCategoriaLang::where('idioma_id', '=', $idioma_id)->where('nombre', '<>', '')->where('noticia_categoria_id', '=', $this->id)->first();

        if ($noticiaCategoriaLang) {
            return $noticiaCategoriaLang;
        } else {
            return new NoticiaCategoriaLang;
        }
    }

    /*
    * Relacion muchos a muchos entre la tabla de categorias y noticias
    */
    public function categoriaNoticias()
    {
        return $this->belongsToMany('App\Models\Noticia', 'noticias_categorias_asociadas', 'categoria_id', 'noticia_id')->withTimestamps();
    }

    public function noticiaCategoriaLangs()
    {
        return $this->hasMany('App\Models\NoticiaCategoriaLang', 'noticia_categoria_id');
    }

    // this is a recommended way to declare event handlers
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) { // before delete() method call this
            $category->noticiaCategoriaLangs()->delete();
        });
    }

    public static function getCategoriaByIdiomaSlug($idioma_id, $slug)
    {
        return NoticiaCategoria::select('noticia_categorias.*')->leftjoin('noticia_categorias_lang', 'noticia_categorias.id', '=', 'noticia_categorias_lang.noticia_categoria_id')->where('noticia_categorias_lang.slug', '=', $slug)->where('noticia_categorias_lang.idioma_id', '=', $idioma_id)->first();
    }

    public function permitirBorrar()
    {
        $errores = array();
        if ($this->categoriaNoticias->isNotEmpty()) {
            $errores[] = 'No se puede eliminar, tiene noticias asociadas.';
        }
        return $errores;
    }

    public function news()
    {
        return $this->belongsToMany(Noticia::class, 'noticias_categorias_asociadas', 'categoria_id', 'noticia_id');
    }

    public function getNameAttribute()
    {
        return $this->lang()->nombre;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return NoticiaCategoriaLang::where('slug', $value)->first()->noticiaCategoria;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? "";
    }
}
