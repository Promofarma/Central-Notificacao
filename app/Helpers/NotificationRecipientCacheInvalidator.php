<?php

namespace App\Helpers;

use App\Models\Notification;

final class NotificationRecipientCacheInvalidator
{
    public static function forget(Notification $notification): void
    {
        $recipientIds = $notification->recipients()->pluck('recipient_id')->toArray();

        ForgetCacheManyKeys::make('notification_recipient:*', $recipientIds)->forgetAll();
    }
}
