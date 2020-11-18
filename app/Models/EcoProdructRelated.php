<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcoProdructRelated extends Model
{
    protected $table = 'eco_products_related';
    protected $fillable = [
        'product_id',
        'eco_friend_id'
    ];
}