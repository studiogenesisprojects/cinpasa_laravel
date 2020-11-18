<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociedColorMaterials extends Model
{
    protected $table = 'associated_materials_colors';
    protected $fillable = [
        'material_id',
        'color_id',
    ];
}