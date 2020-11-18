<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColorsCategoriesRelated extends Model
{
    protected $table = "product_color_product_color_category";

    protected $fillable = [
        'color_id', 'color_category_id',
    ];
}
