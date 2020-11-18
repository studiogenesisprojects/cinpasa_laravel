<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReferenceRelation extends Model
{
    protected $table = 'products_references_relations';
    protected $fillable = [
        'product_id', 'reference_id'
    ];
}