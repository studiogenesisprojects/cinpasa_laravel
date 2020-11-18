<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGalery extends Model
{
    
    protected $fillable = ['video', 'product_id'];
    
    public function images(){
        return $this->hasMany(ProductGaleryImage::class);
    }
}
