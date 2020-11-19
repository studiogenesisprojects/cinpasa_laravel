<?php

namespace App\Models;

use App\ApplicationHome;
use App\TranslatedModel;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class ApplicationCategory extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $fillable = ['list_image', "image", "order", "active"];
    protected $languageModel = ApplicationCategoryLang::class;
    protected $appends = [
        "name",
        "aplication_type",
    ];
    public $langCodeIds = [
        "es" => 1,
        "ca" => 2,
        "en" => 3,
        "fr" => 5,
        "it" => 4,
    ];
    public function getAplicationTypeAttribute()
    {
        return get_class($this);
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($a) {
            $last = ApplicationCategory::orderBy('order', 'DESC')->first();
            $a->order = $last ? $last->order + 1 : 0;
        });
    }

    public function aplications()
    {
        return $this->belongsToMany(Aplication::class);
    }

    public function applicationHome()
    {
        return $this->morphOne(ApplicationHome::class, 'applicationable');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return ApplicationCategoryLang::where('slug', $value)->firstOrFail()->applicationCategory;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? '';
    }

    public function getNameAttribute()
    {
        return !$this->lang() ?: $this->lang()->name;
    }
}
