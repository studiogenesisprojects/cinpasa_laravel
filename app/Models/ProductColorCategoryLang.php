<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductColorCategoryLang extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'description', 'slug', 'language_id', 'product_color_category_id', "seo_title",
        "seo_description"
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($productColorCategoryLang) {
            $productColorCategoryLang->slug = Str::slug($productColorCategoryLang->name, '-');
        });
    }

    public function product_color_category()
    {
        return $this->belongsTo(ProductColorCategory::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
