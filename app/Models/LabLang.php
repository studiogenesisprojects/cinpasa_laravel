<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LabLang extends Model
{
    protected $table = 'labs_lang';
    protected $fillable = [
        'language_id',
        'lab_id',
        "seo_title",
        "seo_description",
        "claim",
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
