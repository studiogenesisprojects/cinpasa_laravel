<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;

class ProductColor extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $fillable = [
        "id", //TODO remove after import
        'pantone', 'rgb_color', 'hex_color', 'active', 'product_color_category_id'
    ];

    protected $appends = [
        "name",
    ];

    protected $languageModel = ProductColorLang::class;

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'product_color', 'color_id', 'product_id');
    // }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'associated_materials_colors', 'color_id', 'material_id')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(ProductColorCategory::class);
    }

    public function shades()
    {
        return $this->belongsToMany(ProductColorShade::class, 'product_color_shades_related');
    }

    public function products()
    {
        $categories = $this->categories;
        $productsWithCategories = [];
        $products = [];

        foreach ($categories as $key => $category) {
            $productsWithCategories[$key] = $category->products;
            foreach ($productsWithCategories[$key] as $key => $producto) {
                $products[$key] = $producto;
            }
        }
        return $products;
    }

    //attributes
    public function getNameAttribute()
    {
        return $this->lang()->name;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return ProductColorLang::where('slug', $value)->firstOrFail()->productColor;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug;
    }
}
