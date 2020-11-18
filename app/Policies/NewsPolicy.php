<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Section;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->section = Section::find(10);
    }

    public function read($user){
        return $user->role->canRead($this->section);
    }
    public function write($user){
        return $user->role->canWrite($this->section);
    }
}
