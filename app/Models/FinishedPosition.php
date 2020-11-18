<?php

namespace App\Models;

use App\TranslatedModel;

class FinishedPosition extends TranslatedModel
{
    protected $languageModel = FinishedPositionLang::class;

    protected $langCodeIds = [
        "es" => 1,
        "ca" => 2,
        "en" => 3,
        "it" => 5,
        "fr" => 4,
    ];
}
