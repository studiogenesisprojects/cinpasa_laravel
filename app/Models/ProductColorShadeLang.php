<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class ProductColorShadeLang extends Model
{
    protected $table = "product_color_shades_lang";

    protected $fillable = ['name', 'description', 'slug', 'language_id', 'product_color_shade_id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($productColorShadeLang) {
            $productColorShadeLang->slug = Str::slug($productColorShadeLang->name, '-');
        });
    }

    public function product_color_shade()
    {
        return $this->belongsTo(ProductColorShade::class);
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
}