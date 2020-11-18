<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOfferInscription extends Model
{
    protected $guarded = ['id'];

    public function job_offer(){
        return $this->belongsTo(JobOffer::class);
    }

    public function job_offer_resume(){
        return $this->hasMany(JobOfferResume::class);
    }
}
