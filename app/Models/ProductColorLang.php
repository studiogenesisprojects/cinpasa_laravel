<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColorLang extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'language_id', 'slug', "product_color_id"];

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }
}
