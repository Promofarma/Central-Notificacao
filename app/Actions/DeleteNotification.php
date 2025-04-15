<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Notification;

final class DeleteNotification
{
    public function handle(Notification $notification): void
    {
        $notification->delete();
    }
}
