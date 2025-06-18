<?php

declare(strict_types=1);

namespace App\Observers;

use App\Helpers\NotificationRecipientCacheInvalidator;
use App\Models\Notification;
use Illuminate\Support\Str;

final class NotificationObserver
{
    public function creating(Notification $notification): void
    {
        $notification->uuid = Str::orderedUuid()->toString();
        $notification->scheduled_time = ($notification->scheduled_date ? config('notification-schedule.default_time') : null);
    }

    public function updated(Notification $notification): void
    {
        NotificationRecipientCacheInvalidator::invalidate($notification);
    }

    public function deleting(Notification $notification): void
    {
        NotificationRecipientCacheInvalidator::invalidate($notification);
    }
}
