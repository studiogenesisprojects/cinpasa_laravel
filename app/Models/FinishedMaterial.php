<?php

namespace App\Models;

use App\TranslatedModel;
use Illuminate\Database\Eloquent\Model;

class FinishedMaterial extends TranslatedModel
{
    protected $table = 'finisheds_materials';

    protected $languageModel = FinishedMaterialLang::class;

    protected $langCodeIds = [
        "es" => 1,
        "ca" => 2,
        "en" => 3,
        "it" => 5,
        "fr" => 4,
    ];
}
