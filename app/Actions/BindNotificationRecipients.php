<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Notification;

final class BindNotificationRecipients
{
    public function handle(Notification $notification, array $recipientIds): void
    {
        $formattedRecipientIds = $this->formatRecipients($recipientIds);

        $notification->recipients()->createMany($formattedRecipientIds);
    }

    private function formatRecipients(array $ids): array
    {
        return array_map(fn (int $id): array => ['recipient_id' => $id], $ids);
    }
}
