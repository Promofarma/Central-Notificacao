<?php

declare(strict_types=1);

namespace App\Actions;

use App\Jobs\ProcessScheduledNotifications;
use App\Models\Notification;

final class CreateNotificationSchedule
{
    public function handle(Notification $notification, array $data): void
    {
        $schedule = $notification->schedule()->create($data);

        ProcessScheduledNotifications::dispatch($schedule);
    }
}
