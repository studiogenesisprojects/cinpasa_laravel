<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishedAplications extends Model
{
    protected $table = 'finished_aplications';
    protected $fillable = [
        'aplication_id',
        'finished_id',
        'order'
    ];

    public function finisheds()
    {
        return $this->belongsToMany('App\Models\Aplication', 'finished_aplications', 'aplication_id', 'finished_id')->withTimestamps();
    }
}