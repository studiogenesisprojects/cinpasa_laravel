<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $table = 'carousel';
    protected $fillable = [
        'name', 'active', 'main', 'section_id'
    ];

    public function slides()
    {
        return $this->hasMany('App\Models\Slide', 'carousel_id', 'id');
    }

    public function section()
    {
        return $this->hasOne(Section::class, 'carousel_id', 'id');
    }
}