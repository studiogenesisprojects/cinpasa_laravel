<?php

namespace App\Models;
use App\TranslatedModel;


class FinishedGaleryImage extends TranslatedModel
{
    protected $languageModel = FinishedGaleryImageLang::class;
    protected $table = 'finisheds_galery_images';
    
    protected $fillable = [
        'galery_id',
        'image',
    ];

    protected $appends = [
        "languagesData"
    ];

    public function finishedGalery()
    {
        return $this->belongsTo('App\Models\Finished', 'galery_id', 'id');
    }

    public function getLanguagesDataAttribute(){
        return FinishedGaleryImageLang::where('language_id', 'finished_galery_image_id')->get();
    }
}