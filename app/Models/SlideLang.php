<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlideLang extends Model
{
    protected $table = 'slides_lang';
    protected $fillable = [
        'language_id',
        'slide_id',
        'alt_img',
        'title_url',
        'title',
        'text',
        'active'
    ];

    public function slide()
    {
        return $this->belongsTo('App\Models\Slide', 'slide_id', 'id');
    }
}