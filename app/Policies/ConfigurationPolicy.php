<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Section;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy
{
    use HandlesAuthorization;

    private $section;
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->section = Section::find(15);
    }

    public function before($user, $ability)
    {
        switch ($ability) {
            case "read":
                return $user->role->canRead($this->section);
            default:
                return $user->role->canWrite($this->section);
        }
    }

    public function read($user)
    {
        return $user->role->canRead($this->section);
    }
    public function write($user)
    {
        return $user->role->canWrite($this->section);
    }

    /**
     * Determine whether the user can view any job offers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the job offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobOffer  $jobOffer
     * @return mixed
     */
    public function view(User $user, JobOffer $jobOffer)
    {
        //
    }

    /**
     * Determine whether the user can create job offers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the job offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobOffer  $jobOffer
     * @return mixed
     */
    public function update(User $user, JobOffer $jobOffer)
    {
        //
    }

    /**
     * Determine whether the user can delete the job offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobOffer  $jobOffer
     * @return mixed
     */
    public function delete(User $user, JobOffer $jobOffer)
    {
        //
    }

    /**
     * Determine whether the user can restore the job offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobOffer  $jobOffer
     * @return mixed
     */
    public function restore(User $user, JobOffer $jobOffer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the job offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobOffer  $jobOffer
     * @return mixed
     */
    public function forceDelete(User $user, JobOffer $jobOffer)
    {
        //
    }
}
