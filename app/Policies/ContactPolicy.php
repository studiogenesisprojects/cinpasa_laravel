<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->section = Section::find(6);
    }

    public function read($user)
    {
        return $user->role->canRead($this->section);
    }
    public function write($user)
    {
        return $user->role->canWrite($this->section);
    }
}