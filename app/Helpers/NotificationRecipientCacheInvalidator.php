<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\Notification;
use Illuminate\Support\Facades\Cache;

final class NotificationRecipientCacheInvalidator
{
    public static function invalidate(Notification $notification): void
    {
        $recipientIds = $notification->recipients()->pluck('recipient_id')->toArray();

        foreach ($recipientIds as $recipientId) {
            $tags = [
                'recipient:'.$recipientId,
                'notification:'.$notification->uuid,
            ];

            $key = 'recipient:'.$recipientId.':notification:'.$notification->uuid;

            Cache::tags($tags)->forget($key);

            self::invalidateInbox($recipientId);
        }
    }

    private static function invalidateInbox(int $recipientId): void
    {
        Cache::tags(['inbox', 'recipient:'.$recipientId])->flush();
    }
}
