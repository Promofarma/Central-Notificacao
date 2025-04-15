<?php

namespace App\Observers;

use App\Helpers\NotificationRecipientCacheInvalidator;
use App\Models\Notification;
use Illuminate\Support\Str;

final class NotificationObserver
{
    public function creating(Notification $notification): void
    {
        $notification->uuid = Str::orderedUuid()->toString();
    }

    public function updated(Notification $notification): void
    {
        NotificationRecipientCacheInvalidator::forget($notification);
    }

    public function deleting(Notification $notification): void
    {
        NotificationRecipientCacheInvalidator::forget($notification);
    }
}
