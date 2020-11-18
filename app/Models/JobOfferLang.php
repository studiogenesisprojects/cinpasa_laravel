<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class JobOfferLang extends Model
{
    protected $table = 'job_offers_lang';
    protected $fillable = [
        'job_offer_id',
        'language_id',
        'name',
        'slug',
        'description',
        'additional_info',
        'time',
        'duration',
        'salary',
        'location',
        'requirements',
    ];

    public static function boot(){
        parent::boot();
        static::creating(function($jobOffer){
            $exists = JobOfferLang::where('slug', $jobOffer->slug)->first();
            if($exists){
                $jobOffer->slug = $exists->slug.'-d';
            }else{
                $jobOffer->slug = Str::slug($jobOffer->slug ?? $jobOffer->name);
            }
        });
    }

    public function offer()
    {
        return $this->belongsTo(JobOffer::class, 'job_offer_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}