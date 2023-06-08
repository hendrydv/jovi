<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InspectionPolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool|null
    {
        if ($user->is_admin) {
            return true;
        }

        return null;
    }

    public function viewAny(): bool
    {
        return false;
    }
}
