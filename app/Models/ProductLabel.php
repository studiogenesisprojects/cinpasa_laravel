<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLabel extends Model
{
    protected $table = 'products_labels';
    protected $fillable = [
        'name', 'description',
    ];
    //
}