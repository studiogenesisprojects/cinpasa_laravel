<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishedMaterialLang extends Model
{
    protected $table = "finished_materials_langs";
    protected $fillable = ["name", "language_id", "finished_material_id"];
}