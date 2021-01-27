<?php

namespace App\Models;

use DB;
use App\Models\Language;
use App\Models\NoticiaLang;
use App\Models\NoticiaRelacionada;
use App\Models\NoticiaBloque;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;

class Noticia extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $table = 'noticias';
    protected $languageModel = NoticiaLang::class;
    protected $languageModelForeignKey = "idioma_id";

    protected $fillable = [
        'fecha_publicacion', 'redactor_id', 'imagen_principal', 'activo'
    ];

    public function setFechaPublicacionAttribute($date)
    {
        $date = str_replace('/', '-', $date);
        return $this->attributes['fecha_publicacion'] = date('Y-m-d', strtotime($date));
    }

    /*
    * Relacion muchos a muchos entre la tabla de noticias y noticias
    */
    public function noticiasRelaciondas()
    {
        return $this->belongsToMany('App\Models\Noticia', 'noticias_relacionadas', 'noticia_id', 'noticia_relacionada')->withTimestamps()->withPivot(['idioma_id', 'orden']);
    }

    /*
    * Relacion muchos a muchos entre la tabla de categorias y noticias
    */
    public function noticiaCategorias()
    {
        return $this->belongsToMany('App\Models\NoticiaCategoria', 'noticias_categorias_asociadas', 'noticia_id', 'categoria_id')->withTimestamps();
    }

    /*
    * Relacion muchos a muchos entre la tabla de etiquetas y noticias
    */
    public function noticiaEtiquetas()
    {
        return $this->belongsToMany('App\Models\NoticiaEtiqueta', 'noticias_etiquetas_asociadas', 'noticia_id', 'etiqueta_id')->withTimestamps();
    }

    /*
    * Relacion uno a muchos entre la tabla de documentos y noticias
    */
    public function noticiaDocumentos()
    {
        return $this->hasMany('App\Models\NoticiaDocumento', 'noticia_id');
    }

    public function noticiasLangs()
    {
        return $this->hasMany('App\Models\NoticiaLang', 'noticia_id');
    }

    public function noticiasBloques()
    {
        return $this->hasMany('App\Models\NoticiaBloque', 'noticia_id');
    }

    public function redactor()
    {
        return $this->belongsTo('App\Models\NoticiaRedactor');
    }

    public function getGaleria()
    {
        return $this->belongsTo('App\Models\Galery', 'galeria_id');
    }

    public static function noticiaFiltradas($fecha_ini = '', $fecha_fin = '', $titular = '', $categoria_id = '', $etiqueta_id = '', $redactor_id = '', $idioma_id = '', $noticia_id = 0)
    {
        $registros = Noticia::select('noticias.*');

        // Preparamos las uniones de tablas
        if ($categoria_id != '') {
            $registros = $registros->leftJoin('noticias_categorias_asociadas', 'noticias.id', '=', 'noticias_categorias_asociadas.noticia_id');
        }

        if ($etiqueta_id != '') {
            $registros = $registros->leftJoin('noticias_etiquetas_asociadas', 'noticias.id', '=', 'noticias_etiquetas_asociadas.noticia_id');
        }

        if ($idioma_id != '' || $titular != '') {
            $registros = $registros->leftJoin('noticias_lang', 'noticias.id', '=', 'noticias_lang.noticia_id');
        }

        // Comienzan los where
        if ($fecha_ini != '') {
            $registros = $registros->where('noticias.fecha_publicacion', '>=', $fecha_ini);
        }

        if ($fecha_fin != '') {
            $registros = $registros->where('noticias.fecha_publicacion', '<=', $fecha_fin);
        }

        if ($categoria_id != '') {
            $registros = $registros->where('noticias_categorias_asociadas.categoria_id', '=', $categoria_id);
        }

        if ($etiqueta_id != '') {
            $registros = $registros->where('noticias_etiquetas_asociadas.etiqueta_id', '=', $etiqueta_id);
        }

        if ($redactor_id != '') {
            $registros = $registros->where('noticias.redactor_id', '=', $redactor_id);
        }

        if ($titular != '') {
            $registros = $registros->where('noticias_lang.titulo', 'like', '%' . $titular . '%');
        }

        if ($noticia_id != 0) {
            $registros = $registros->where('noticias.id', '<>', $noticia_id);
        }

        // Consideramos que pertenete a un idioma si alguno de los campos de texto no están vacios
        // campos de texto: titulo, subtitulo, texto_corto y texto
        if ($idioma_id != '') {
            $registros = $registros->where('noticias_lang.idioma_id', '=', $idioma_id)->where(function ($query) {
                $query->orWhere('noticias_lang.titulo', '<>', '')->orWhere('noticias_lang.subtitulo', '<>', '')->orWhere('noticias_lang.texto_corto', '<>', '')->orWhere('noticias_lang.slug', '<>', '');
            });
        }

        $registros = $registros->groupby('noticias.id', 'noticias.fecha_publicacion', 'noticias.redactor_id', 'noticias.imagen_principal', 'noticias.activo', 'noticias.created_at', 'noticias.updated_at')->orderBy('noticias.fecha_publicacion', 'DESC')->paginate(25);

        return $registros;
    }

    public function noticiaLang($idioma_id)
    {
        if (empty($this->id)) {
            return new NoticiaLang;
        }

        $noticiaLang = NoticiaLang::where('idioma_id', '=', $idioma_id)->where('titulo', '<>', '')->where('noticia_id', '=', $this->id)->first();

        if ($noticiaLang) {
            return $noticiaLang;
        } else {
            return new NoticiaLang;
        }
    }

    public function idiomasNoticia()
    {
        return Language::select('language.*')->leftJoin('noticias_lang', 'language.id', '=', 'noticias_lang.idioma_id')->where('noticias_lang.titulo', '<>', "")->where('noticias_lang.noticia_id', '=', $this->id)->get();
    }

    public function noticiasRelacionadas($idioma_id)
    {
        if (empty($this->id)) {
            return collect(new NoticiaRelacionada);
        }

        $noticiasRelacionadas = NoticiaRelacionada::where('idioma_id', '=', $idioma_id)->where('noticia_id', '=', $this->id)->get();

        return $noticiasRelacionadas;
    }

    public function noticiaBloquesLang($idioma_id)
    {
        if (empty($this->id)) {
            return collect(new NoticiaBloque);
        }

        $noticiaBloques = NoticiaBloque::where('idioma_id', '=', $idioma_id)->where('noticia_id', '=', $this->id)->orderBy('orden', 'ASC')->get();

        return $noticiaBloques;
    }

    public function noticiaBloquesLangMap($idioma_id)
    {
        if (empty($this->id)) {
            return collect(new NoticiaBloque);
        }

        $noticiaBloques = NoticiaBloque::where('idioma_id', '=', $idioma_id)->where('noticia_id', '=', $this->id)->where('tipo_bloque', '=', '5')->orderBy('orden', 'ASC')->get();

        return $noticiaBloques;
    }

    /**
     * Obtener las noticias que cumplen las condiciones pasadas por parámetro
     * @param  [int]  $idioma_id     [id del idioma en el que se quiere recuperar]
     * @param  string  $order_by      [campo por el que se quieren ordenar]
     * @param  string  $sentido_orden [sentido de ordenacion 'DESC' o 'ASC']
     * @param  array   $excluir       [array de ids de noticias a no considerar]
     * @param  integer $cantidad      [cantidad de noticias a recuperar, si es 0 se recuperan todas]
     * @return [object Noticia]       [Objetos de tipo noticias]
     */
    public static function getNoticias($idioma_id, $excluir = array(), $cantidad = 0, $order_by = 'noticias.fecha_publicacion', $sentido_orden = 'DESC')
    {
        $registros =  Noticia::select('noticias.*')->leftjoin('noticias_lang', 'noticias.id', '=', 'noticias_lang.noticia_id')->where('noticias.activo', 1)->where('noticias.fecha_publicacion', '<=', date('Y-m-d'))->where('noticias_lang.idioma_id', $idioma_id)->where('noticias_lang.titulo', '<>', '');
        if (count($excluir)) {
            $registros = $registros->whereNotIn('noticias.id', $excluir);
        }

        $registros = $registros->orderBy($order_by, $sentido_orden)->orderBy('id', 'DESC');
        if ($cantidad) {
            $registros = $registros->take($cantidad);
        }

        $registros = $registros->get();

        return $registros;
    }

    /**
     * Obtener las noticias que cumplen las condiciones pasadas por parámetro
     * @param  [int]  $idioma_id     [id del idioma en el que se quiere recuperar]
     * @param  string  $order_by      [campo por el que se quieren ordenar]
     * @param  string  $sentido_orden [sentido de ordenacion 'DESC' o 'ASC']
     * @param  array   $excluir       [array de ids de noticias a no considerar]
     * @param  integer $cantidad      [cantidad de noticias a recuperar, si es 0 se recuperan todas]
     * @return [object Noticia]       [Objetos de tipo noticias]
     */
    public static function getNoticiasListadoAjax($idioma_id, $fecha, $excluir = array(), $cantidad = 0, $order_by = 'noticias.fecha_publicacion', $sentido_orden = 'DESC')
    {
        $fecha = date('Y-m-d', strtotime($fecha));

        $registros =  Noticia::select('noticias.*')->leftjoin('noticias_lang', 'noticias.id', '=', 'noticias_lang.noticia_id')->where('noticias.activo', 1)->where('noticias.fecha_publicacion', '<=', $fecha)->where('noticias_lang.idioma_id', $idioma_id)->where('noticias_lang.titulo', '<>', '');
        if (count($excluir)) {
            $registros = $registros->whereNotIn('noticias.id', $excluir);
        }

        $registros = $registros->orderBy($order_by, $sentido_orden)->orderBy('id', 'DESC');
        if ($cantidad) {
            $registros = $registros->take($cantidad);
        }

        $registros = $registros->get();
        return $registros;
    }

    public static function getNoticiaByIdiomaSlug($idioma_id, $slug)
    {
        return Noticia::select('noticias.*')->leftjoin('noticias_lang', 'noticias.id', '=', 'noticias_lang.noticia_id')->where('noticias.activo', 1)->where('noticias.fecha_publicacion', '<=', date('Y-m-d'))->where('noticias_lang.slug', '=', $slug)->where('noticias_lang.idioma_id', '=', $idioma_id)->first();
    }

    public static function getNoticiasBuscador($idioma_id, $palabra, $categoria_id, $excluir = array(), $cantidad = 0)
    {
        $registros = Noticia::select('noticias.*');
        if ($palabra != '') {
            $registros = $registros->leftJoin('noticias_lang', function ($join) use ($idioma_id) {
                $join->on('noticias.id', '=', 'noticias_lang.noticia_id');
                $join->on('noticias_lang.idioma_id', '=', DB::raw($idioma_id));
            })->leftJoin('noticias_bloques', function ($join) use ($idioma_id) {
                $join->on('noticias.id', '=', 'noticias_bloques.noticia_id');
                $join->on('noticias_bloques.idioma_id', '=', DB::raw($idioma_id));
            })->leftJoin('bloque_textos', 'noticias_bloques.bloque_id', '=', 'bloque_textos.id');
        }

        if ($categoria_id != '') {
            $registros = $registros->leftJoin('noticias_categorias_asociadas', 'noticias.id', '=', 'noticias_categorias_asociadas.noticia_id');
        }

        if ($categoria_id != '') {
            $registros = $registros->where('noticias_categorias_asociadas.categoria_id', '=', $categoria_id);
        }

        if ($palabra != '') {
            // Consideramos que pertenete a un idioma si alguno de los campos de texto no están vacios
            // campos de texto: titulo, subtitulo, texto_corto y texto
            $registros = $registros->where(function ($query) use ($palabra) {
                $query->orWhere('noticias_lang.titulo', 'like', '%' . $palabra . '%')->orWhere('noticias_lang.subtitulo', 'like', '%' . $palabra . '%')->orWhere('noticias_lang.texto_corto', 'like', '%' . $palabra . '%')->orWhere('bloque_textos.texto', 'like', '%' . $palabra . '%');
            });
        }

        if (count($excluir)) {
            $registros = $registros->whereNotIn('noticias.id', $excluir);
        }

        $registros = $registros->where('noticias.activo', '=', 1)->where('noticias.fecha_publicacion', '<=', date('Y-m-d'))->groupby('noticias.id', 'noticias.fecha_publicacion', 'noticias.redactor_id', 'noticias.imagen_principal', 'noticias.activo', 'noticias.created_at', 'noticias.updated_at')->orderBy('noticias.fecha_publicacion', 'DESC')->orderBy('id', 'DESC');

        if ($cantidad) {
            $registros = $registros->take($cantidad);
        }

        $registros = $registros->get();

        return $registros;
    }

    public static function getNoticiasBuscadorAjax($idioma_id, $palabra, $categoria_id, $fecha, $excluir = array(), $cantidad = 0)
    {
        $registros = Noticia::select('noticias.*');
        if ($palabra != '') {
            $registros = $registros->leftJoin('noticias_lang', function ($join) use ($idioma_id) {
                $join->on('noticias.id', '=', 'noticias_lang.noticia_id');
                $join->on('noticias_lang.idioma_id', '=', DB::raw($idioma_id));
            })->leftJoin('noticias_bloques', function ($join) use ($idioma_id) {
                $join->on('noticias.id', '=', 'noticias_bloques.noticia_id');
                $join->on('noticias_bloques.idioma_id', '=', DB::raw($idioma_id));
            })->leftJoin('bloque_textos', 'noticias_bloques.bloque_id', '=', 'bloque_textos.id');
        }

        if ($categoria_id != '') {
            $registros = $registros->leftJoin('noticias_categorias_asociadas', 'noticias.id', '=', 'noticias_categorias_asociadas.noticia_id');
        }

        if ($categoria_id != '') {
            $registros = $registros->where('noticias_categorias_asociadas.categoria_id', '=', $categoria_id);
        }

        if ($palabra != '') {
            // Consideramos que pertenete a un idioma si alguno de los campos de texto no están vacios
            // campos de texto: titulo, subtitulo, texto_corto y texto
            $registros = $registros->where(function ($query) use ($palabra) {
                $query->orWhere('noticias_lang.titulo', 'like', '%' . $palabra . '%')->orWhere('noticias_lang.subtitulo', 'like', '%' . $palabra . '%')->orWhere('noticias_lang.texto_corto', 'like', '%' . $palabra . '%')->orWhere('bloque_textos.texto', 'like', '%' . $palabra . '%');
            });
        }

        if (count($excluir)) {
            $registros = $registros->whereNotIn('noticias.id', $excluir);
        }

        $registros = $registros->where('noticias.activo', '=', 1)->where('noticias.fecha_publicacion', '<=', date('Y-m-d'))->groupby('noticias.id', 'noticias.fecha_publicacion', 'noticias.redactor_id', 'noticias.imagen_principal', 'noticias.activo', 'noticias.created_at', 'noticias.updated_at')->orderBy('noticias.fecha_publicacion', 'DESC')->orderBy('id', 'DESC');

        if ($cantidad) {
            $registros = $registros->take($cantidad);
        }

        $registros = $registros->get();

        return $registros;
    }

    public static function getNoticiaMasLeidas($idioma_id, $id_excluir)
    {
        return Noticia::select('noticias.*')->leftjoin('noticias_lang', 'noticias.id', '=', 'noticias_lang.noticia_id')->where('noticias.activo', 1)->where('noticias.fecha_publicacion', '<=', date('Y-m-d'))->where('noticias.id', '<>', $id_excluir)->where('noticias_lang.idioma_id', '=', $idioma_id)->orderBy('noticias.visionada', 'DESC')->orderBy('id', 'DESC')->take(4)->get();
    }

    /**
     * Obtener las noticias que contienen una categoría
     * @param  [int]  $idioma_id    [id del idioma a buscar los textos]
     * @param  [int]  $categoria_id [id de la categoría]
     * @param  array   $excluir      [ids de noticias a no tener en cuenta en la búsqueda]
     * @param  integer $cantidad     [número de noticias a recuperar, 0 = todas]
     * @param  string  $fecha        [fecha desde la cual hacer la búsqueda hacia atrás]
     * @return [objett]               [Noticias]
     */
    public static function getNoticiasFromCategory($idioma_id, $categoria_id, $excluir = array(), $cantidad = 0, $fecha = '')
    {
        $registros = Noticia::select('noticias.*')->leftJoin('noticias_categorias_asociadas', function ($join) use ($categoria_id) {
            $join->on('noticias.id', '=', 'noticias_categorias_asociadas.noticia_id');
        })->leftJoin('noticias_lang', function ($join) use ($idioma_id) {
            $join->on('noticias.id', '=', 'noticias_lang.noticia_id');
            $join->on('noticias_lang.idioma_id', '=', DB::raw($idioma_id));
        });

        if (count($excluir)) {
            $registros = $registros->whereNotIn('noticias.id', $excluir);
        }

        if ($fecha != '') {
            $registros = $registros->where('noticias.fecha_publicacion', '<=', date('Y-m-d', strtotime($fecha)));
        } else {
            $registros = $registros->where('noticias.fecha_publicacion', '<=', date('Y-m-d'));
        }

        $registros = $registros->where('noticias.activo', 1)->where('noticias_lang.titulo', '<>', '')->where('noticias_categorias_asociadas.categoria_id', '=', $categoria_id)->orderBy('noticias.fecha_publicacion', 'DESC')->orderBy('id', 'DESC');

        if ($cantidad) {
            $registros = $registros->take($cantidad);
        }

        $registros = $registros->get();

        return $registros;
    }

    /**
     * Obtener las noticias que contienen una etiqueta
     * @param  [int]  $idioma_id    [id del idioma a buscar los textos]
     * @param  [int]  $etiqueta [id de la etiqueta]
     * @param  array   $excluir      [ids de noticias a no tener en cuenta en la búsqueda]
     * @param  integer $cantidad     [número de noticias a recuperar, 0 = todas]
     * @param  string  $fecha        [fecha desde la cual hacer la búsqueda hacia atrás]
     * @return [objett]               [Noticias]
     */
    public static function getNoticiasFromLabel($idioma_id, $etiqueta_id, $excluir = array(), $cantidad = 0, $fecha = '')
    {
        $registros = Noticia::select('noticias.*')->leftJoin('noticias_etiquetas_asociadas', function ($join) use ($etiqueta_id) {
            $join->on('noticias.id', '=', 'noticias_etiquetas_asociadas.noticia_id');
        })->leftJoin('noticias_lang', function ($join) use ($idioma_id) {
            $join->on('noticias.id', '=', 'noticias_lang.noticia_id');
            $join->on('noticias_lang.idioma_id', '=', DB::raw($idioma_id));
        });

        if (count($excluir)) {
            $registros = $registros->whereNotIn('noticias.id', $excluir);
        }

        if ($fecha != '') {
            $registros = $registros->where('noticias.fecha_publicacion', '<=', date('Y-m-d', strtotime($fecha)));
        } else {
            $registros = $registros->where('noticias.fecha_publicacion', '<=', date('Y-m-d'));
        }

        $registros = $registros->where('noticias.activo', 1)->where('noticias_lang.titulo', '<>', '')->where('noticias_etiquetas_asociadas.etiqueta_id', '=', $etiqueta_id)->orderBy('noticias.fecha_publicacion', 'DESC')->orderBy('id', 'DESC');

        if ($cantidad) {
            $registros = $registros->take($cantidad);
        }

        $registros = $registros->get();

        return $registros;
    }

    public function getNameAttribute()
    {
        return $this->lang()->titulo;
    }

    public function getTextoCortoAttribute()
    {
        return $this->lang()->texto_corto;
    }

    public function getUrlAttribute()
    {
        return LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.news.show', [
            "noticia" => $this,
        ]);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return NoticiaLang::where('slug', $value)->firstOrFail()->noticia;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? "";
    }

    public function getActiveAttribute()
    {
        return $this->lang()->active;
    }
}
