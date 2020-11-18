<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleryImage extends Model
{
    protected $table = 'galeria_imagenes';
    protected $fillable = [
        'imagen', 'galeria_id', 'orden',
    ];

    public function imagenesTextos()
    {
        return $this->hasMany('App\Models\GaleryImageLang', 'galeria_imagen_id');
    }

    public function imagenesTextoIdioma($idioma_id)
    {
        $texto = GaleryImageLang::where('idioma_id', '=', $idioma_id)->where('galeria_imagen_id', '=', $this->id)->first();
        if ($texto) {
            return $texto;
        }

        return false;
    }

    // this is a recommended way to declare event handlers
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($galeriaImagen) { // before delete() method call this
            $galeriaImagen->imagenesTextos()->delete();
        });
    }
}