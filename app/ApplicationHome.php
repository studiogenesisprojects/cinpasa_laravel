<?php

namespace App;

use App\Models\Aplication;
use Illuminate\Database\Eloquent\Model;

class ApplicationHome extends Model
{
    protected $fillable = [
        "order", "aplication_id", "aplication_type"
    ];

    protected $appends = [
        'name'
    ];

    public function applicationable()
    {
        return $this->morphTo(__FUNCTION__, 'aplication_type', 'aplication_id');
    }

    public function getNameAttribute()
    {
        return $this->applicationable->name ?? "";
    }
}
