<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryLang extends Model
{
    protected $fillable = [
        "language_id", "id",
        'name',
        'description',
        'footer_description',
        'product_category_id',
        "slug",
        "seo_title",
        "seo_description",
    ];
    public $timestamps = false;

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
