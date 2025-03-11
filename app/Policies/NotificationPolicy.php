<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Notification;
use App\Models\User;

class NotificationPolicy
{
    public function delete(User $user, Notification $notification): bool
    {
        return $user->id === $notification->user_id;
    }
}
