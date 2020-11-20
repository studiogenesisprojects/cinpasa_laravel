<?php

namespace App\Models;

use App\ApplicationHome;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;

class Aplication extends TranslatedModel implements LocalizedUrlRoutable
{


    protected $fillable = [
        'name',
        'subtitle',
        'lite_description',
        'description',
        'father_category',
        'order',
        'list_image',
        'primary_image',
        'image_alt',
        'active'
    ];

    protected $languageModel = AplicationLang::class;

    protected $appends = [
        'name',
        "aplication_type"
    ];
    public function getAplicationTypeAttribute()
    {
        return get_class($this);
    }

    public function childs()
    {
        return $this->hasMany(Aplication::class, 'sup_aplication');
    }

    public function supApplication()
    {
        return $this->belongsTo(Aplication::class, 'sup_aplication');
    }

    public function applicationCategories()
    {
        return $this->belongsToMany(ApplicationCategory::class);
    }

    public function finisheds()
    {
        return $this->belongsToMany('App\Models\Finished', 'finished_aplications', 'aplication_id', 'finished_id')->withTimestamps()->withPivot('order');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_applications', 'application_id', 'product_id')->where('active', 1);
    }

    public function getNameAttribute()
    {
        return $this->lang()->name;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return AplicationLang::where('slug', $value)->firstOrFail()->application;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? '';
    }

    public function applicationHome()
    {
        return $this->morphOne(ApplicationHome::class, 'applicationable');
    }

    public static function getLangIndex($code)
    {
        $indexes  = [
            "es" => 1,
            "ca" => 2,
            "en" => 3,
            "ru" => 5,
            "fr" => 4,
        ];
        return $indexes[$code];
    }
}
