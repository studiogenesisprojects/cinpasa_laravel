<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use App\TranslatedModel;

class JobOffer extends TranslatedModel implements LocalizedUrlRoutable
{

    protected $guarded = ['id'];
    protected $languageModel = JobOfferLang::class;

    public function job_offer_inscriptions()
    {
        return $this->hasMany(JobOfferInscription::class);
    }

    public function job_offer_resumes()
    {
        return $this->hasManyThrough(JobOfferResume::class, JobOfferInscription::class);
    }

    public function job_offer_langs()
    {
        return $this->hasMany(JobOfferLang::class, 'job_offer_id');
    }

    //attributes
    public function getNameAttribute()
    {
        return $this->lang()->name;
    }

    public function getDescriptionAttribute()
    {
        return $this->lang()->description;
    }

    public function getSlugAttribute()
    {
        return $this->lang()->slug;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return JobOfferLang::where('slug', $value)->firstOrFail()->offer;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang($locale)->slug ?? "";
    }
}
