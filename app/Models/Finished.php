<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\TranslatedModel;

class Finished extends TranslatedModel implements LocalizedUrlRoutable
{
    protected $languageModel = FinishedLang::class;

    protected $langCodeIds = [
        "es" => 1,
        "ca" => 2,
        "en" => 3,
        "it" => 5,
        "fr" => 4,
    ];

    protected $fillable = [
        'list_image',
        'section_image',
        'galery_id',
        'active',
        'order'
    ];

    protected $appends = ['name', 'alt'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($a) {
            $last = Finished::orderBy('order', 'DESC')->first();
            $a->order = $last ? $last->order + 1 : 0;
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_finishes', 'finish_id', 'product_id')->withPivot('order');
    }

    public static function ponerOrder()
    {
        $materials = Finished::all();
        foreach ($materials as $key => $value) {
            $value->update([
                'order' => $key + 1
            ]);
        }
    }

    public function positions()
    {
        return $this->belongsToMany(FinishedPosition::class, 'finished_position_related');
    }

    public function sizes()
    {
        return $this->belongsToMany(FinishedSize::class, 'finished_size_related');
    }

    public function colors()
    {
        return $this->belongsToMany(FinishedColor::class, 'finished_color_related');
    }

    public function materials()
    {
        return $this->belongsToMany(FinishedMaterial::class, 'finished_materials_related', 'finished_id', 'finished_material_id')->withTimestamps();
    }

    public function aplications()
    {
        return $this->belongsToMany('App\Models\Aplication', 'finished_aplications', 'finished_id', 'aplication_id')->whereHas('languages', function ($q) {
            $q->where('active', true)->where('language_id', Aplication::getLangIndex(app()->getLocale()));
        })->withTimestamps()->withPivot('order');
    }

    public function galery()
    {
        return $this->belongsTo(FinishedGalery::class);
    }

    public function galeryImages()
    {
        return $this->hasMany('App\Models\FinishedGaleryImage', 'galery_id', 'id');
    }

    //attributes
    public function getNameAttribute()
    {
        return $this->lang()->name;
    }

    public function getImageAttribute()
    {
        return Storage::url($this->list_image);
    }

    public function getSubtitleAttribute()
    {
        return $this->lang()->subtitle;
    }

    public function getSlugAttribute()
    {
        return $this->lang()->slug;
    }

    public function getUrlAttribute()
    {
        return LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.endings.show', [
            "finished" => $this,
        ]);
    }

    public function getLocaleAttribute()
    {
        return LaravelLocalization::getCurrentLocale();
    }

    public function getLiteDescriptionAttribute()
    {
        return $this->lang()->lite_description;
    }

    public function getLargeDescriptionAttribute()
    {
        return $this->lang()->large_description;
    }

    public function getObservationsAttribute()
    {
        return $this->lang()->observations;
    }

    public function getAltAttribute()
    {
        return $this->lang()->alt ?? "";
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return FinishedLang::where('slug', $value)->firstOrFail()->finished;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale) ? $this->lang($locale)->slug : "";
    }
}
