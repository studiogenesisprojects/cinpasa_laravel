<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EcoFriendLang extends Model
{
    protected $fillable = [
        "language_id",
        "eco_friend_id",
        "name"
    ];
}
