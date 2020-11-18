<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishedGaleryImageLang extends Model
{
    protected $fillable = [
        "name", 
        "alt",
        "language_id",
        "finished_galery_image_id"
    ];

}
