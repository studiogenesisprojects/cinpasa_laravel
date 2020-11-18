<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MaterialLang extends Model
{
    protected $table = 'materials_lang';
    protected $fillable = [
        'material_id',
        'language_id',
        'name',
        'description',
        'slug',
        "seo_title",
        "seo_description",
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($materialLang) {
            $materialLang->slug = Str::slug($materialLang->name, '-');
        });
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
