<?php

namespace App\Models;

use App\TranslatedModel;

class FinishedColor extends TranslatedModel
{
    protected $languageModel = FinishedColorLang::class;

    protected $langCodeIds = [
        "es" => 1,
        "ca" => 2,
        "en" => 3,
        "it" => 5,
        "fr" => 4,
    ];
}
