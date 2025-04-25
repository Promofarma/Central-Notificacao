<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\CreateNotificationSchedule;
use App\Events\NotificationReady;

final class ScheduleRecurrentNotification
{
    public function __construct()
    {
    }

    public function handle(NotificationReady $event): void
    {
        $data = $event->data;

        /** @var \App\Models\Notification $notification */
        $notification = $event->notification;

        if (! $event->data['is_recurrent']) {
            return;
        }

        (new CreateNotificationSchedule)->handle(
            notification: $notification,
            data: $data['recurrence']
        );
    }
}
