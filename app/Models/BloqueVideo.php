<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloqueVideo extends Model
{
    protected $table = 'bloque_videos';
    protected $fillable = [
        'clase', 'codigo', 'pie_video',  'activo'
    ];
}
