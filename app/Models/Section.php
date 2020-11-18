<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';
    protected $fillable = [
        'name', 'carousel_id'
    ];

    public function carousel()
    {
        return $this->hasOne(Carousel::class, 'section_id', 'id');
    }
}