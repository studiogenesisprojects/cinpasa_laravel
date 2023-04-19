<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCaracteristics extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "rapport",
        "width",
        'pockets',
        'laces',
        'bags',
        'packaging',
        "length",
        "flecortin_head",
        "flecortin_width",
        'presentation',
        'stock',
        'material_id',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
