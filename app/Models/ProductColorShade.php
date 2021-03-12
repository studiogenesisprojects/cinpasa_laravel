<?php

namespace App\Models;

use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ProductColorShade extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $langCodeIds = [
        "es" => 1,
        "ca" => 2,
        "en" => 3,
        "ru" => 5,
        "fr" => 4,
    ];

    protected $languageModel = ProductColorShadeLang::class;

    protected $fillable = ['searcher_order'];

    protected $appends = ['name'];


    public function colors()
    {
        return $this->belongsToMany(ProductColor::class, 'product_color_shades_related');
    }

    //included attributes
    public function getLang()
    {
        return $this->hasOne(ProductColorShadeLang::class)->where('language_id', $this->langCodeIds[App::getLocale()]);
    }

    public function getNameAttribute()
    {
        if (!$this->lang()) {
            Log::channel('translations')->info("ProductCategory con id: " . $this->id . " no tiene traducciones");
            return "";
        }
        return $this->lang()->name;
    }

    public function getDescriptionAttribute()
    {
        if (!$this->lang()) {
            Log::channel('translations')->info("ProductCategory con id: " . $this->id . " no tiene traducciones");
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
