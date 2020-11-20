<?php

namespace App;

use Illuminate\Support\Facades\App;

class NewsTag extends TranslatedModel
{
    protected $languageModel = NewsTagLang::class;

    protected $appends = [
        'title',
    ];

    public function news()
    {
        return $this->belongsToMany(News::class);
    }
    public function getTitleAttribute()
    {
        return $this->lang(App::getLocale())->title ?? "";
    }
}
