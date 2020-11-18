<?php

namespace App\Models;

use App\TranslatedModel;

class ProductForm extends TranslatedModel
{

    protected $langCodeIds = [
        "es" => 1,
        "ca" => 2,
        "en" => 3,
        "it" => 5,
        "fr" => 4,
    ];
    protected $languageModel = FormLang::class;
    protected $table = 'products_forms';

    protected $fillable = ['type', 'searcher_order'];

    public function finished()
    {
        return $this->hasOne('App\Mdoels\Finished', 'form_id', 'id');
    }

    public function languages()
    {
        return $this->hasMany(FormLang::class, 'form_id');
    }

    public function getNameAttribute()
    {
        return $this->lang(app()->getLocale())->name;
    }
}
