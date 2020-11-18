<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BloqueGaleria;
use App\Models\BloqueImagen;
use App\Models\BloqueMapa;
use App\Models\BloqueSeparador;
use App\Models\BloqueTexto;
use App\Models\BloqueVideo;

class NoticiaBloque extends Model
{
    protected $table = 'noticias_bloques';
    protected $fillable = [
        'noticia_id', 'idioma_id', 'bloque_id', 'tipo_bloque', 'orden',
    ];

    public function getInfoBloque($id_bloque, $tipo_bloque) {
        if (empty($this->id)) {
            return '';
        }

        switch ((int) $tipo_bloque) {
            case 1:
                $bloque = BloqueTexto::find($id_bloque);
                break;
            case 2:
                $bloque = BloqueImagen::find($id_bloque);
                break;
            case 3:
                $bloque = BloqueGaleria::find($id_bloque);
                break;
            case 4:
                $bloque = BloqueVideo::find($id_bloque);
                break;
            case 5:
                $bloque = BloqueMapa::find($id_bloque);
                break;
            case 6:
                $bloque = BloqueSeparador::find($id_bloque);
                break;
        }

        if ($bloque) {
            return $bloque;
        } else {
            return '';
        }
    }

    public function getInfoBloqueFront() {
        if (empty($this->id)) {
            return '';
        }

        $id_bloque = $this->bloque_id;
        $tipo_bloque = $this->tipo_bloque;

        switch ((int) $tipo_bloque) {
            case 1:
                $bloque = BloqueTexto::where('id', '=', $id_bloque)->where('activo', '=', 1)->first();
                break;
            case 2:
                $bloque = BloqueImagen::where('id', '=', $id_bloque)->where('activo', '=', 1)->first();
                break;
            case 3:
                $bloque = BloqueGaleria::where('id', '=', $id_bloque)->where('activo', '=', 1)->first();
                break;
            case 4:
                $bloque = BloqueVideo::where('id', '=', $id_bloque)->where('activo', '=', 1)->first();
                break;
            case 5:
                $bloque = BloqueMapa::where('id', '=', $id_bloque)->where('activo', '=', 1)->first();
                break;
            case 6:
                $bloque = BloqueSeparador::where('id', '=', $id_bloque)->where('activo', '=', 1)->first();
                break;
        }

        if ($bloque) {
            return $bloque;
        } else {
            return '';
        }
    }
}
