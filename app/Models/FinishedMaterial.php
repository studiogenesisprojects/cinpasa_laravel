<?php

namespace App\Models;

use App\TranslatedModel;
use Illuminate\Database\Eloquent\Model;

class FinishedMaterial extends TranslatedModel
{
    protected $table = 'finisheds_materials';

    protected $languageModel = FinishedMaterialLang::class;


}
