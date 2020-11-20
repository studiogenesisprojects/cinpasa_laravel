<?php

namespace App\Models;

use App\TranslatedModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class Slide extends TranslatedModel
{
    protected $table = 'slides';

    protected $languageModel = SlideLang::class;


    protected $fillable = [
        'carousel_id',
        'image',
        'url',
        'order'
    ];

    protected $appends = [
        'alt_img',
        'title_url',
        'title',
        'text'
    ];



    public static function boot()
    {
        parent::boot();
        static::deleting(function ($slide) {
            $slide->languages()->delete();
        });
    }


    public function carousel()
    {
        return $this->belongsTo('App\Models\carousel', 'carousel_id', 'id');
    }

    public function getTitleUrlAttribute()
    {
        return $this->lang()->title_url;
    }

    public function getTitleAttribute()
    {
        return $this->lang()->title;
    }

    public function getAltImgAttribute()
    {
        return $this->lang()->alt_img;
    }

    public function getTextAttribute()
    {
        return $this->lang()->text;
    }


}
