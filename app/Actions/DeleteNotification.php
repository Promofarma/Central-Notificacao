<?php

declare(strict_types=1);

namespace App\Actions;

use App\Helpers\ForgetCacheManyKeys;
use App\Models\Notification;

final class DeleteNotification
{
    public function handle(Notification $notification): void
    {
        $recipientIds = $notification->recipients->pluck('recipient_id')->toArray();

        $notification->delete();

        $this->forgetNotificationRecipientCache($recipientIds);
    }

    private function forgetNotificationRecipientCache(array $recipientIds): void
    {
        ForgetCacheManyKeys::make('notification_recipient:*', $recipientIds)->forgetAll();
    }
}
