<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Writer extends TranslatedModel
{
    protected $fillable = ['image', "name", "email", "facebook", "twitter", "linkedin"];
    protected $languageModel = WriterLang::class;

}
