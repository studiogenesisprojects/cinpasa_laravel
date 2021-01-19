<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;

class Material extends TranslatedModel implements LocalizedUrlRoutable
{

    protected $languageModel = MaterialLang::class;



    protected $fillable = [
        "id", //TODO remove after import
        'order',
        'sup_material',
        "searcher_order",
        "active"
    ];

    protected $appends = [
        "name",
        "description",
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($a) {
            $last = Material::orderBy('order', 'DESC')->first();
            $a->order = $last ? $last->order + 1 : 0;
        });
    }

    public static function ponerOrder()
    {
        $materials = Material::all();
        foreach ($materials as $key => $value) {
            $value->update([
                'order' => $key + 1
            ]);
        }
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_materials', 'material_id', 'product_id')->where('active', 1);
    }

    /**
     * si el material es padre, podemos llamar sus hij@s
     */
    // public function childs()
    // {
    //     return $this->hasMany(Material::class, 'sup_material');
    // }

    // public function father()
    // {
    //     return $this->belongsTo(Material::class, 'sup_material');
    // }

    public function categories()
    {
        return $this->belongsToMany(MaterialCategory::class, 'material_material_categories');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Models\ProductColor', 'associated_materials_colors', 'material_id', 'color_id')->withTimestamps();
    }

    public function hasColor($id)
    {
        return $this->whereHas('colors', function (Builder $query) use ($id) {
            $query->where('materials.id', $id);
        })->exists();
    }

    public function finisheds()
    {
        return $this->belongsToMany('App\Models\Finished', 'finisheds_materials', 'material_id', 'finished_id')->withTimestamps();
    }

    public function hasFinisheds($id)
    {
        return $this->whereHas('finisheds', function (Builder $query) use ($id) {
            $query->where('materials.id', $id);
        })->exists();
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

    public function getSlugAttribute()
    {
        return $this->lang()->slug;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return MaterialLang::where('slug', $value)->firstOrFail()->material;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? "";
    }
}
