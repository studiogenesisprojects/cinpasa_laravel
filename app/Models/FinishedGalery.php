<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishedGalery extends Model
{
    protected $table = 'finisheds_galery';
    protected $fillable = [
        'video',
    ];

    public function images(){
        return $this->hasMany(FinishedGaleryImage::class, 'galery_id');
    }
}