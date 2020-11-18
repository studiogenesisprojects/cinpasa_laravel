<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOfferResume extends Model
{
    protected $guarded = ['id'];

    public function job_offer_inscription()
    {
        return $this->belongsTo(JobOfferInscription::class);
    }

    public function job_offer()
    {
        return $this->job_offer_inscription->job_offer;
    }
}