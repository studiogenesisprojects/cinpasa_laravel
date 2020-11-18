<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = ['id'];

    public function permissions(){
        return $this->hasMany(Permission::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function canRead(Section $section){
        return $this->permissions->where('section_id', '=', $section->id)->where('read', true)->count() > 0;
    }

    public function canWrite(Section $section){
        return $this->permissions->where('section_id', '=', $section->id)->where('write', true)->count() > 0;
    }

}
