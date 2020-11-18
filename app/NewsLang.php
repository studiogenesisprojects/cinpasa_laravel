<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsLang extends Model
{
    protected $fillable = [
        "news_id",
        "language_id",
        "title",
        "subtitle",
        "slug",
        "description",
        "content",
        "seo_title",
        "seo_description",
        "active",
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
