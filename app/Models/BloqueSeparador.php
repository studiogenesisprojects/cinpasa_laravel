<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloqueSeparador extends Model
{
    protected $table = 'bloque_separadores';
    protected $fillable = [
        'clase', 'activo',
    ];
}
