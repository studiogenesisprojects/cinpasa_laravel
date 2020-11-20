<?php

namespace App\Models;

use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;

class MaterialCategory  extends TranslatedModel implements LocalizedUrlRoutable
{

    protected $fillable = ["id", "active", "order"];

    protected $languageModel = MaterialCategoryLang::class;

    protected $appends = [
        "name"
    ];


    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_material_categories');
    }

    public function getNameAttribute()
    {
        return $this->lang()->name;
    }
}
