<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishedColorLang extends Model
{
    protected $fillable = ["name", "language_id", "finished_color_id"];
}
