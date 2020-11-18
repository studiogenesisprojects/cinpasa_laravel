<?php

namespace App\Models;

use App\Models\NoticiaRedactorLang;
use Illuminate\Database\Eloquent\Model;

class NoticiaRedactor extends Model
{
    protected $table = 'noticia_redactores';
    protected $fillable = [
        'nombre', 'email', 'facebook', 'twitter', 'linkedin', 'slug', 'activo', 'imagen',
    ];

    public static function noticiaRedactorFiltradas($nombre = '', $slug = '')
    {
        $registros = NoticiaRedactor::select('noticia_redactores.*');

        if ($nombre != '') {
            $registros = $registros->where('nombre', 'like', '%' . $nombre . '%');
        }

        if ($slug != '') {
            $registros = $registros->where('slug', 'like', '%' . $slug . '%');
        }

        $registros = $registros->orderBy('id', 'DESC')->paginate(25);

        return $registros;
    }

    public function noticiaRedactorLang($idioma_id)
    {
        if (empty($this->id)) {
            return new NoticiaRedactorLang;
        }

        $noticiaRedactorLang = NoticiaRedactorLang::where('idioma_id', '=', $idioma_id)->where('noticia_redactor_id', '=', $this->id)->first();

        if ($noticiaRedactorLang) {
            return $noticiaRedactorLang;
        } else {
            return new NoticiaRedactorLang;
        }
    }

    public function redactorNoticias()
    {
        return $this->hasMany('App\Models\Noticia', 'redactor_id');
    }

    public function noticiaRedactorLangs()
    {
        return $this->hasMany('App\Models\NoticiaRedactorLang', 'noticia_redactor_id');
    }

    // this is a recommended way to declare event handlers
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($redactor) { // before delete() method call this
            $redactor->noticiaRedactorLangs()->delete();
        });
    }
    public function permitirBorrar()
    {
        $errores = array();
        if ($this->redactorNoticias->isNotEmpty()) {
            $errores[] = 'No se puede eliminar, tiene noticias asociadas.';
        }
        return $errores;
    }
}