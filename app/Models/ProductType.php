<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'products_type';
    protected $fillable = ['active'];

    public function finished()
    {
        return $this->hasOne('App\Mdoels\Finished', 'type_id', 'id');
    }

    public function typeLangs()
    {
        return $this->hasMany(TypeLang::class, 'type_id');
    }

    public function lang($id = null)
    {
        if (gettype($id) == "string") {
            $langid = Language::where('code', $id ?? 'es')->first()->id;
            return $this->typeLangs->where('language_id', $langid)->first();
        }
        return $this->typeLangs->where('language_id', $id ?? 1)->first();
    }

    //attributes
    public function getNameAttribute()
    {
        return $this->lang()->name;
    }
    public function getDescriptionAttribute()
    {
        return $this->lang()->description;
    }
}
