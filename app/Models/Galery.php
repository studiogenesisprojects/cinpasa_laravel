<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galerias';
    protected $fillable = [
        'fecha', 'titulo', 'activo',
    ];

    public function setFechaAttribute($date)
    {
        $date = str_replace('/', '-', $date);
        return $this->attributes['fecha'] = date('Y-m-d', strtotime($date));
    }

    public static function galeriasFiltradas($titulo = '', $fecha = '')
    {
        $registros = Galery::select('galerias.*');

        if ($titulo != '') {
            $registros = $registros->where('titulo', 'like', '%' . $titulo . '%');
        }

        if ($fecha != '') {
            $fecha = str_replace('/', '-', $fecha);
            $fecha = date('Y-m-d', strtotime($fecha));
            $registros = $registros->where('fecha', '=', $fecha);
        }

        $registros = $registros->orderBy('id', 'DESC')->paginate(25);

        return $registros;
    }

    public function imagenesGaleria()
    {
        return $this->hasMany('App\Models\GaleryImage', 'galeria_id')->orderBy('orden', 'ASC');
    }

    public function galeriaNoticias()
    {
        return Galery::select('galerias.*')->leftJoin('bloque_galerias', 'galerias.id', '=', 'bloque_galerias.galeria_id')->leftJoin('noticias_bloques', 'bloque_galerias.id', '=', 'noticias_bloques.bloque_id')->where('noticias_bloques.tipo_bloque', '=', 3)->where('bloque_galerias.galeria_id', '=', $this->id)->groupBy('noticias_bloques.noticia_id')->get()->count();
    }

    // this is a recommended way to declare event handlers
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($galeria) { // before delete() method call this
            $galeria->imagenesGaleria()->delete();
        });
    }

    public function permitirBorrar()
    {
        $errores = array();
        if ($this->galeriaNoticias()) {
            $errores[] = 'No se puede eliminar, tiene noticias asociadas.';
        }
        return $errores;
    }
}