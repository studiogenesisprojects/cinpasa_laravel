<?php

namespace App\Models;

use App\EcoFriendLang;
use App\TranslatedModel;
use Illuminate\Support\Facades\App;

class EcoFriend extends TranslatedModel
{
    public $timestamps = false;

    protected $languageModel = EcoFriendLang::class;


    protected $fillable = [
        'image'
    ];

    protected $appends = [
        "name"
    ];

    public function getNameAttribute()
    {
        return $this->lang(App::getLocale())->name ?? "";
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'eco_products_related', 'eco_friend_id', 'product_id');
    }
}
