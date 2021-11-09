<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasFactory;

    use HasTranslations;

    protected $fillable = [
        'name', 'active', 'image', 'order', 'product_id'
    ];

    public $translatable = ['image'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
