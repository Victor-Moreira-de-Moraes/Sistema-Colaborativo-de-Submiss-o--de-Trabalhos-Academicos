<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return true;
    }

    public function view(User $user, Team $team): bool
    {
        return $team->owner_id === $user->id
            || $team->members()->where('user_id', $user->id)->exists();
    }

    public function update(User $user, Team $team): bool
    {
        return $team->owner_id === $user->id;
    }

    public function delete(User $user, Team $team): bool
    {
        return $team->owner_id === $user->id;
    }

    // opcional, se você quiser separar convite de “update”
    public function invite(User $user, Team $team): bool
    {
        return $team->owner_id === $user->id;
    }
}
