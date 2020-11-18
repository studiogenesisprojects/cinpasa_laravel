<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class NewsRelatedNews extends Model
{
    protected $fillable = [
        "news_id",
        "related_news_id",
        "order"
    ];
}
