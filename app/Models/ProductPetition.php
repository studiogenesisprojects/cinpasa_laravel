<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPetition extends Model
{
    protected $table = 'products_petions';
    protected $fillable = [
        'product_id', 'petition_id'
    ];
}