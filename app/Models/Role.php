<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = ['id'];
	
	protected $fillable = [
        'name',
    ];
	
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

    public function canDelete(Section $section){
        return $this->permissions->where('section_id', '=', $section->id)->where('delete', true)->count() > 0;
    }
}
