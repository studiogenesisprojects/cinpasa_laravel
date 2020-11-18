<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\TranslatedModel;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class ProductBraided extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $table = 'products_braideds';
    protected $langCodeIds = [
        "es" => 1,
        "ca" => 4,
        "en" => 2,
        "it" => 5,
        "fr" => 3,
    ];

    protected $fillable = ['searcher_order'];

    protected $languageModel = BraidLang::class;

    public function finished()
    {
        return $this->hasOne('App\Mdoels\Finished', 'brided_id', 'id');
    }

    public function getNameAttribute()
    {
        return $this->lang()->name;
    }
}
