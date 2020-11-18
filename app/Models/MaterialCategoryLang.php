<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialCategoryLang extends Model
{
    protected $fillable = [
        'material_category_id',
        'language_id',
        'name',
        'description',
        'slug',
        "seo_title",
        "seo_description",
    ];
}
