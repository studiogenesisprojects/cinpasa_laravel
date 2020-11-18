<?php

namespace App\Models;

use App\TranslatedModel;
use Illuminate\Database\Eloquent\Model;

class ProductGaleryImage extends TranslatedModel
{
    protected $languageModel = ProductGaleryImageLang::class;

    protected $fillable = ['path', 'product_galery_id'];

    public function languages()
    {
        return $this->hasMany(ProductGaleryImageLang::class);
    }
}
