<?php

namespace App\Policies;

use App\Models\Greeting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GreetingPolicy
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
    public function show(User $user, Greeting $greeting){
        return $user->role->name === 'admin' || $user->id === $greeting->sender_id || $user->id === $greeting->receiver_id;
    }

    public function update(User $user, Greeting $greeting){
        return $user->role->name === 'admin' || $user->id === $greeting->sender_id;
    }
}
