<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductColorCategory extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $languageModel = ProductColorCategoryLang::class;

    protected $langCodeIds = [
        "es" => 1,
        "ca" => 2,
        "en" => 3,
        "it" => 5,
        "fr" => 4,
    ];

    protected $fillable = ['active', 'order'];

    protected $appends = ['name'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($a) {
            $last = ProductColorCategory::orderBy('order', 'DESC')->first();
            if (!$a->order) {
                $a->order = $last ? $last->order + 1 : 0;
            }
        });
    }


    public function colors()
    {
        return $this->belongsToMany(ProductColor::class)->orderBy('order')->withPivot('order');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color_category_relations', 'color_category_id', 'product_id');
    }

    //included attributes
    public function getNameAttribute()
    {
        return $this->lang()->name ?? "";
    }

    public function getDescriptionAttribute()
    {
        if (!$this->lang()) {
            return "";
        }
        return $this->lang()->description;
    }

    public function getSlugAttribute()
    {
        if (!$this->lang()) {
            Log::channel('translations')->info("ProductCategory con id: " . $this->id . " no tiene traducciones");
            return "";
        }
        return $this->lang()->slug;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return ProductColorCategoryLang::where('slug', $value)->firstOrFail()->product_color_category;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? "";
    }
}
