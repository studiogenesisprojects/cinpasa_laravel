<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApplicationCategoryLang extends Model
{
    protected $fillable = ['language_id', 'application_category_id', 'name', 'alt', 'description', 'slug', "seo_title", "seo_description"];

    public static function boot()
    {
        parent::boot();
        self::updating(function ($item) {
            $item->slug = Str::slug($item->slug);
        });
        self::creating(function ($item) {
            $item->slug = Str::slug($item->slug);
        });
    }

    public function applicationCategory()
    {
        return $this->belongsTo(ApplicationCategory::class);
    }
}
