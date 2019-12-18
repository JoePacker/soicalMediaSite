<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class CommentPolicy
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
     * Determine whether the user can create comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (Gate::allows('create_comment')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        if (Gate::allows('edit_any_comment')) {
            return true;
        }

        if (Gate::allows('edit_own_comment') && $user->id === $comment->user_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        if (Gate::allows('delete_any_comment')) {
            return true;
        }

        if (Gate::allows('delete_own_comment') && $user->id === $comment->user_id) {
            return true;
        }
    }
}
