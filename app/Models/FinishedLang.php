<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FinishedLang extends Model
{
    protected $table = 'finisheds_langs';
    protected $fillable = [
        "id",
        'finished_id',
        'language_id',
        'name',
        'slug',
        'lite_description',
        'subtitle',
        'large_description',
        'observations',
        "seo_title",
        "seo_description",
        "alt",
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($finishedLang) {
            $slug = Str::slug($finishedLang->name, '-');
            if (FinishedLang::where('slug', $slug)->count() > 0) {
                //TODO mejorar esto
                $finishedLang->slug = $slug . '1';
            } else {
                $finishedLang->slug = $slug;
            }
        });
    }

    public function finished()
    {
        return $this->belongsTo(Finished::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
