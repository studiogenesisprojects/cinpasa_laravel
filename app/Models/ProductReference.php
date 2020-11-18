<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReference extends Model
{
    protected $table = 'products_references';
    protected $fillable = [
        "id", //TODO remove after import
        'referencia', 'diametro'
    ];

    public function product()
    {
        return $this->belongsToMany(ProductReference::class, 'products_references_relations', 'reference_id', 'product_id');
    }
}
