<?php

namespace App\Policies;

use App\Profile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can bypass authorisation.
     *
     * @param  \App\User  $user
     * @param  string  $ability
     * @return mixed
     */
    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the profile.
     *
     * @param  \App\User  $user
     * @param  \App\Profile  $profile
     * @return mixed
     */
    public function update(User $user, Profile $profile)
    {
        if (Gate::allows('edit_any_profile')) {
            return true;
        }

        if (Gate::allows('edit_own_profile') && $user->id === $profile->user_id) {
            return true;
        }
    }
}
