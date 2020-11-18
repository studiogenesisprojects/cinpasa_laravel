<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLabelRelated extends Model
{
    protected $table = 'products_labels_relation';
    protected $fillable = [
        'product_id', 'label_id'
    ];
}