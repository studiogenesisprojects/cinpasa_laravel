<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGaleryImageLang extends Model
{
    protected $fillable = ['product_galery_image_id', 'language_id', 'alt'];
}
