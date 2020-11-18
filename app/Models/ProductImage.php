<?php

namespace App\Models;

use App\TranslatedModel;

class ProductImage extends TranslatedModel
{
    protected $languageModel = ProductImageLang::class;
    protected $guarded = ['id'];

    protected $appends = [
        "alt",
    ];

    public function getAltAttribute()
    {
        return $this->lang()->alt ?? "";
    }
}
