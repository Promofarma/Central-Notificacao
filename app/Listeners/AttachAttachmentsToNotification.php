<?php

namespace App\Listeners;

use App\Actions\BindNotificationAttachments;
use App\Events\NotificationReady;

final class AttachAttachmentsToNotification
{
    public function __construct() {}

    public function handle(NotificationReady $event): void
    {
        if (filled($attachments = $event->data['attachments'])) {
            (new BindNotificationAttachments)->handle(
                notification: $event->notification,
                attachments: $attachments
            );
        }
    }
}
