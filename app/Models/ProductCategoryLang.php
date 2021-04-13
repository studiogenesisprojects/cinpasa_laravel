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
        'alt_text_image_1',
        'alt_text_image_2',
        'alt_text_image_3',
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
