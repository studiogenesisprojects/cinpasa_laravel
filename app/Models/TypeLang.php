<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeLang extends Model
{
    protected $table = 'type_lang';
    protected $fillable = [
        'language_id',
        'type_id',
        'name',
        'description'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Slide', 'id', 'type_id');
    }
}