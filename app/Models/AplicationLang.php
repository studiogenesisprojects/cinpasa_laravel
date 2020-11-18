<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AplicationLang extends Model
{
    protected $table = 'aplications_lang';
    protected $fillable = [
        'language_id',
        'aplication_id',
        'description',
        'slug',
        'name',
        "seo_title",
        "seo_description",
        "active",
        "image_alt"
    ];

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

    public function application()
    {
        return $this->belongsTo(Aplication::class, 'aplication_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
