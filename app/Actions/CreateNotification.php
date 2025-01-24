<?php

declare(strict_types=1);

namespace App\Actions;

use App\Helpers\ForgetCacheManyKeys;
use App\Models\Notification;

final class CreateNotification
{
    public function handle(array $data): Notification
    {
        $recipientIds = $data['recipient_ids'];

        unset($data['recipient_ids']);

        $notification = Notification::query()->create($data);

        (new BindNotificationRecipients())->handle(
            notification: $notification,
            recipientIds: $recipientIds
        );

        ForgetCacheManyKeys::make(
            key: 'recipient.*.notifications',
            values: $recipientIds
        )->forgetAll();

        return $notification;
    }
}
