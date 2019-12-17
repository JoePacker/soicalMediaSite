<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', 'App\User');

        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['member', 'moderator']);
        })->get();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.index')->with('status', 'The user was successfully deleted');
    }


}
