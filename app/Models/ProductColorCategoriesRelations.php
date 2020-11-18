<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColorCategoriesRelations extends Model
{
    protected $table = "product_color_category_relations";

    protected $fillable = [
        'product_id', 'color_category_id', 'order'
    ];
}