<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    use HandlesAuthorization;

    // return true or false
    // first param: currentUser, second param: authorised user
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    
    public function show(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    public function edit(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    


}
