<?php

namespace App\Models;

use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Facades\LaravelLocalization as FacadesLaravelLocalization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;
use Illuminate\Support\Facades\Log;

class Product extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $languageModel = ProductLang::class;

    protected $fillable = [
        "liasa_code",
        "order",
        "active",
        "category_id",
        "type_id",
        "form_id",
        "brided_id",
        "video",
        "product_image_id",
        "outlet",
        "lab_id",
        'discount'
    ];

    protected $appends = [
        'name',
        'slug',
        'images',
        'description',
        'colors',
        'lite_description',
        'primary_image_url',
        "class",
        "url"
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($a) {
            $last = Product::orderBy('order', 'DESC')->first();
            $a->order = $last ? $last->order + 1 : 0;
        });
        static::updating(function ($a) {
            $a->active = $a->active === true;
        });
    }

    public function galeries()
    {
        return $this->hasMany(ProductGalery::class);
    }

    public function caracteristics()
    {
        return $this->hasMany(ProductCaracteristics::class);
    }

    public function references()
    {
        return $this->belongsToMany(ProductReference::class, 'products_references_relations', 'product_id', 'reference_id');
    }
    public function categoryColors()
    {
        return $this->belongsToMany(ProductColorCategory::class, 'product_color_category_relations', 'product_id', 'color_category_id')->withPivot('order');
    }

    public function colors2()
    {

        $categories = $this->categoryColors;
        $colorsWithCategories = [];
        $colors = [];

        foreach ($categories as $key => $category) {
            $colorsWithCategories[$key] = $category->colors;
            foreach ($colorsWithCategories[$key] as $key => $producto) {
                $colors[$key] = $producto;
            }
        }
        return collect($colors);
    }


    public function materials()
    {
        return $this->belongsToMany(Material::class, 'product_materials');
    }

    public function applicationCategories()
    {
        return $this->hasManyThrough(ApplicationCategory::class, Aplication::class);
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function form()
    {
        return $this->belongsTo(ProductForm::class);
    }

    public function braided()
    {
        return $this->belongsTo(ProductBraided::class, 'brided_id');
    }

    public function labels()
    {
        return $this->belongsToMany(ProductLabel::class, 'products_labels_relation', 'product_id', 'label_id')->withPivot('order');
    }

    public function ecoLogos()
    {
        return $this->belongsToMany(EcoFriend::class, 'eco_products_related', 'product_id', 'eco_friend_id');
    }

    public function colorCategories()
    {
        return $this->belongsToMany(ProductColorCategory::class, 'product_color_category_relations', 'product_id', 'color_category_id')->withPivot('order');
    }

    public function applications()
    {
        return $this->belongsToMany(Aplication::class, 'product_applications', 'product_id', 'application_id')->withPivot('order');
    }

    public function finisheds()
    {
        return $this->belongsToMany(Finished::class, 'product_finishes', 'product_id', 'finish_id')->withPivot('order');
    }

    public function labs()
    {
        return $this->belongsToMany(Lab::class, 'product_labs', 'product_id', 'lab_id');
    }

    public function higherDiscount()
    {
        return $this->hasOne(ProductCaracteristics::class)->orderBy('discount', 'desc')->take(1);
    }

    public function relateds()
    {
        $relateds = Product::whereHas('categories',function($q) {
                        $q->whereIn('product_categories.id', $this->categories->pluck('id'));
                    })->where('id', '!=', $this->id)->inRandomOrder()->limit(4)->get();

        return $relateds;
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class)->where('active', true)->withPivot('order');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage()
    {
        return $this->belongsTo(ProductImage::class, 'product_image_id');
    }

    //included attributes
    public function getColorsAttribute()
    {
        return $this->colors2();
    }
    public function getNameAttribute()
    {
        if (!$this->lang()) {
            Log::channel('translations')->info("Product con id: " . $this->id . " no tiene traducciones");
            return "";
        }
        return $this->attributes['name'] = $this->lang()->name ?? "";
    }

    public function getSlugAttribute()
    {
        if (!$this->lang()) {
            Log::channel('translations')->info("Product con id: " . $this->id . " no tiene traducciones");
            return "";
        }
        return $this->lang(app()->getLocale())->slug ?? "";
    }

    public function getDescriptionAttribute()
    {
        if (!$this->lang()) {
            Log::channel('translations')->info("Product con id: " . $this->id . " no tiene traducciones");
            return "";
        }
        return $this->lang(app()->getLocale())->description ?? "";
    }

    public function getLiteDescriptionAttribute()
    {
        return $this->lang(app()->getLocale())->lite_description ?? "";
    }

    public function getPrimaryImageUrlAttribute()
    {
        return $this->primaryImage->path ?? '';
    }

    public function getImagesAttribute()
    {
        return $this->images()->get()->filter(function ($image) {
            return $image->id != $this->product_image_id;
        })->map(function ($image) {
            return [
                "url" => Storage::url($image->path),
                "id" => $image->id
            ];
        });
    }

    public function getCategorySlugAttribute()
    {
        return $this->category->lang(app()->getLocale())->slug;
    }

    public function getUrl($locale)
    {

        if($this->outlet){
            $route = 'routes.outlet.show';
        } else {
            $route ='routes.products.showProduct';
        }

        return LaravelLocalization::getURLFromRouteNameTranslated($locale, $route, [
            "productCategory" => $this->categories->first(),
            "product" => $this,
        ]);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return ProductLang::where('slug', $value)->whereHas('product', function ($q) {
            $q->where('active', 1);
        })->firstOrFail()->product;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? "";
    }

    public static function arreglarOrder()
    {
        $productosOrdenados = Product::orderBy('liasa_code')->get();
        foreach ($productosOrdenados as $key => $producto) {
            $producto->update([
                'order' => $producto->liasa_code,
                'liasa_code' => null
            ]);
        }
        return "ok";
    }

    public function getClassAttribute()
    {
        if (
            $this->categories->contains(23430) ||
            $this->categories->contains(23450) ||
            $this->categories->contains(23480)
        ) {
            return "bg-elastic-cordon";
        }
        if (
            $this->categories->contains(23505) ||
            $this->categories->contains(40710) ||
            $this->categories->contains(29626)
        ) {
            return "bg-elastic-ribbon";
        }
        if (
            $this->categories->contains(23495) ||
            $this->categories->contains(23500)
        ) {
            return "bg-ribbon";
        }
        return "bg-cover";
    }

    public function getUrlAttribute()
    {
        /*if($this->outlet){
            $route = 'routes.outlet.show';
        } else {*/
            $route ='routes.products.showProduct';
        //}

        return  FacadesLaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), $route, [
            "productCategory" => $this->categories->first(),
            "product" => $this
        ]);
    }

    public static function getLangIndex($code)
    {
        $indexes  = [
            "es" => 1,
            "ca" => 2,
            "en" => 3,
            "ru" => 5,
            "fr" => 4,
        ];
        return $indexes[$code];
    }
}
