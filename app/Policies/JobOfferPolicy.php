<?php

namespace App\Policies;

use App\Models\JobOffer;
use App\Models\User;
use App\Models\Section;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobOfferPolicy
{
    use HandlesAuthorization;

    private $section;

    public function __construct()
    {
        $this->section = Section::find(11);
    }

    public function before($user, $ability)
    {

        switch ($ability) {
            case "viewAny":
                return $user->role->canRead($this->section);
            default:
                return $user->role->canWrite($this->section);
        }
    }

    public function viewAny()
    { }
}
