<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WriterLang extends Model
{
    protected $fillable = [
        "writer_id",
        "language_id",
        "description"
    ];
}
