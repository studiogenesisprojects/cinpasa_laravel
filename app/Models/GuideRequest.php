<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        "email",
        "product_id"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

}
