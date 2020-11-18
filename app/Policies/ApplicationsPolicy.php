<?php

namespace App\Policies;

use App\ModelsAplication;
use App\Models\User;
use App\Models\Section;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationsPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        $this->section = Section::find(7);
    }

    public function read($user){
        return $user->role->canRead($this->section);
    }
    public function write($user){
        return $user->role->canWrite($this->section);
    }
}
