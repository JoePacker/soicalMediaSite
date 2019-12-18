<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class PostPolicy
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
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (Gate::allows('create_post')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if (Gate::allows('edit_any_post')) {
            return true;
        }

        if (Gate::allows('edit_own_post') && $user->id === $post->user_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        if (Gate::allows('delete_any_post')) {
            return true;
        }

        if (Gate::allows('delete_own_post') && $user->id === $post->user_id) {
            return true;
        }
    }
}
