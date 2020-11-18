<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BraidLang extends Model
{
    protected $table = 'braids_langs';
    protected $fillable = [
        'language_id',
        'product_braided_id',
        'name',
        'description'
    ];
}
