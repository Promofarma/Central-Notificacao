<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Actions\BindNotificationRecipients;
use App\Events\NotificationReady;
use App\Factories\RecipientResolverFactory;
use Illuminate\Support\Facades\Cache;

final class AttachRecipientsToNotification
{
    public function __construct()
    {
    }

    public function handle(NotificationReady $event): void
    {
        /** @var array<string,mixed> $data */
        $data = $event->data;

        $recipientResolver = RecipientResolverFactory::make($data['target_type']);

        $recipientIds = $recipientResolver->resolve($data);

        (new BindNotificationRecipients)->handle(
            notification: $event->notification,
            recipientIds: $recipientIds,
        );

        $this->cleanCache($recipientIds);
    }

    private function cleanCache(array $recipientIds): void
    {
        foreach ($recipientIds as $recipientId) {
            Cache::tags(['inbox', 'recipient:'.$recipientId])->flush();
        }
    }
}
