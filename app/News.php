<?php

namespace App;

use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class News extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $languageModel = NewsLang::class;
    protected $fillable = [
        "id",
        "created_at",
        "active",
        "image",
        "thumbnail",
        "writer_id"
    ];
    protected $appends = [
        "title",
        "url"
    ];
    protected $langCodeIds = [
        "es" => 1,
        "ca" => 2,
        "en" => 3,
        "it" => 5,
        "fr" => 4,
    ];

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }
    public function tags()
    {
        return $this->belongsToMany(NewsTag::class);
    }
    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class);
    }
    public function relatedNews()
    {
        return $this->hasManyThrough(News::class, NewsRelatedNews::class, 'news_id', 'id', 'id', 'related_news_id');
    }

    //appends
    public function getTitleAttribute()
    {
        return $this->lang(App::getLocale())->title ?? $this->languages->where('title', '!=', null)->first()->title ?? "";
    }
    public function getUrlAttribute()
    {
        return LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.news.show', [
            "news" => $this,
        ]);
    }
    public function resolveRouteBinding($value)
    {
        return NewsLang::where('slug', $value)->where('language_id', $this->langCodeIds[App::getLocale()])->where('active', true)->firstOrFail()->news;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? '';
    }
}
