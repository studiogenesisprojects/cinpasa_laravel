<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloqueTexto extends Model
{
    protected $table = 'bloque_textos';
    protected $fillable = [
        'clase', 'texto', 'activo'
    ];
}