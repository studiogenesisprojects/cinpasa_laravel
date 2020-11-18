<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductLang extends Model
{
    protected $fillable = [
        "product_id",
        "language_id",
        "name",
        "slug",
        "lite_description",
        "description",
        "seo_title",
        "seo_description",
        "active"
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = Str::slug($product->slug ?? $product->name);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
