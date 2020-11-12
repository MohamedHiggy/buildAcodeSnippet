<?php

namespace App\Policies;

use App\User;
use App\Step;
use Illuminate\Auth\Access\HandlesAuthorization;

class StepPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Step $step)
    {
        return $user->id === $step->snippet->user_id;
    }

    public function destroy(User $user, Step $step)
    {
        return $user->id === $step->snippet->user_id;
    }
}
