<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;

class ProductCategory extends TranslatedModel implements LocalizedUrlRoutable
{


    protected $fillable = [
        "sup_product_category",
        "image",
        'searcher_order',
        'active',
        'order'
    ];

    protected $appends = [
        "name"
    ];

    protected $languageModel = ProductCategoryLang::class;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function outlet_products()
    {
        return $this->belongsToMany(Product::class)->whereHas('caracteristics',function($q) {
            $q->whereNotNull('discount');
        });
    }

    public function father()
    {
        return $this->belongsTo(ProductCategory::class, 'sup_product_category');
    }

    public function childrens()
    {
        return $this->hasMany(ProductCategory::class, 'sup_product_category')->where('active', true)->orderBy('order', 'ASC');
    }

    //attributes
    public function getNameAttribute()
    {
        return $this->lang()->name;
    }
    public function getDescriptionAttribute()
    {
        return $this->lang()->description;
    }
    public function getFooterDescriptionAttribute()
    {
        return $this->lang()->footer_description;
    }
    public function getSlugAttribute()
    {
        return $this->lang()->slug;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return ProductCategoryLang::where('slug', $value)->firstOrFail()->productCategory;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? "";
    }

    public function getClassAttribute()
    {
        if (
            $this->id == 23430 ||
            $this->id == 23450 ||
            $this->id == 23480 ||
            $this->id == 23475
        ) {
            return "bg-elastic-cordon";
        }
        if (
            $this->id == 23505 ||
            $this->id == 40710 ||
            $this->id == 29626
        ) {
            return "bg-elastic-ribbon";
        }
        if (
            $this->id == 23495 ||
            $this->id == 23500
        ) {
            return "bg-ribbon";
        }
        return "bg-cover";
    }
}
