<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRelated extends Model
{
    protected $table = 'products_related';
    protected $fillable = [
        'product_id', 'related_id',
    ];
}