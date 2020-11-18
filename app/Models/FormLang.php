<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormLang extends Model
{
    protected $table = 'forms_langs';
    protected $fillable = [
        'language_id',
        'form_id',
        'name',
        'description'
    ];
}