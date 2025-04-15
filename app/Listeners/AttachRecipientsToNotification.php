<?php

namespace App\Listeners;

use App\Actions\BindNotificationRecipients;
use App\Events\NotificationReady;
use App\Factories\RecipientResolverFactory;
use App\Helpers\ForgetCacheManyKeys;

final class AttachRecipientsToNotification
{
    public function __construct() {}

    public function handle(NotificationReady $event): void
    {
        /** @var array<string,mixed> $data */
        $data = $event->data;

        $recipientResolver = RecipientResolverFactory::make($data['target_type']);

        $ids = $recipientResolver->resolve($data);

        (new BindNotificationRecipients)->handle(
            notification: $event->notification,
            recipientIds: $ids,
        );

        ForgetCacheManyKeys::make('notification_recipient:*', $ids)->forgetAll();
    }
}
