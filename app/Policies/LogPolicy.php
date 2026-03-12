<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Log;

class LogPolicy
{
    public function view(User $user, Log $log): bool
    {
        return $user->id === $log->user_id;
    }

    public function delete(User $user, Log $log): bool
    {
        return $user->id === $log->user_id;
    }
}
