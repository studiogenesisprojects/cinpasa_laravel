<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColorShadeRelated extends Model
{
    protected $table = "product_color_shades_related";

    protected $fillable = [
        'product_color_shade_id', 'product_color_id', 'order',
    ];
}