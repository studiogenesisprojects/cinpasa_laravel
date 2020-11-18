<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImageLang extends Model
{
    protected $fillable = ["product_image_id", 'alt', 'language_id'];
}
