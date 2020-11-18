<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeatured extends Model
{

    protected $fillable = [
        "order",
        "news_id",
        "featured",
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
