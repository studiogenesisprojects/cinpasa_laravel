<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsTagLang extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "language_id",
        "news_category_id"
    ];
}
