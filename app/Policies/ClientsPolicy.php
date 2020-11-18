<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use App\Models\Section;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientsPolicy
{
    use HandlesAuthorization;

    private $section;

    public function __construct(){
        $this->section = Section::find(12);
    }
    public function read($user){
        return $user->role->canRead($this->section);
    }
    public function write($user){
        return $user->role->canWrite($this->section);
    }
}
