<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\TranslatedModel;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class ProductBraided extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $table = 'products_braideds';


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
