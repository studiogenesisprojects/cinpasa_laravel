<?php

namespace App\Models;

use App\TranslatedModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab  extends Model
{
    use HasFactory;

    // protected $languageModel = LabLang::class;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_labs')->orderBy('order');
    }

    public function langs() {
        return LabLang::where('lab_id', $this->id)->get();
    }

    public function lang($lang_code) {
        $lang = Language::where('code', $lang_code)->first();
        return LabLang::where('lab_id', $this->id)->where('language_id', $lang->id)->first();
    }
}
