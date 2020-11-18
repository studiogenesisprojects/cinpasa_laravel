<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    protected $table = 'petitions';
    protected $fillable = [
        "fullname",
        "origen",
        "company",
        "email",
        "origen",
        "phone_number",
        "country",
        "comment",
        "state",
    ];

    public function  formattedState()
    {
        switch ($this->state) {
            case 0:
                return "No leído";
            case 1:
                return "Leído";
            case 2:
                return "Archivado";
        }
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_petions', 'petition_id', 'product_id');
    }

    public function petitionProducts()
    {
        return $this->hasMany(ProductPetition::class);
    }
}
