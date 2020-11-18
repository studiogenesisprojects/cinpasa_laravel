<?php

namespace App\Models;

use App\Models\Galery;
use Illuminate\Database\Eloquent\Model;

class BloqueGaleria extends Model
{
    protected $table = 'bloque_galerias';
    protected $fillable = [
        'clase', 'galeria_id', 'pie_galeria', 'activo',
    ];

    /*
     * Devuelve los datos de una galería, pero se comprueba si está activa.
     */
    public function getGaleriaByIdFront()
    {
    
        $galeria = Galery::where('id', '=', $this->galeria_id)->where('activo', '=', 1)->first();

        if ($galeria) {
            return $galeria;
        } else {
            return '';
        }
    }
}
