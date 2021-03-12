<?php

namespace App\Models;

use App\ApplicationHome;
use App\TranslatedModel;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use Illuminate\Support\Facades\App;

class ApplicationCategory extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $fillable = ['list_image', "image", "order", "active"];
    protected $languageModel = ApplicationCategoryLang::class;
    protected $appends = [
        "name",
        "aplication_type",
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

    public function getLang()
    {
        return $this->hasOne(ApplicationCategoryLang::class)->where('language_id', $this->langCodeIds[App::getLocale()]);
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
