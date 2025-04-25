<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTO\NotificationDTO;
use App\Events\NotificationReady;
use App\Models\Notification;

final class CreateNotification
{
    public function handle(array $data): Notification
    {
        $notification = Notification::query()->create(
            NotificationDTO::fromArray($data)->toArray()
        );

        event(new NotificationReady($notification, $this->normalizeData($data)));

        return $notification;
    }

    private function normalizeData(array $data): array
    {
        return [
            'target_type' => 'recipients',
            'send_to_all_recipients' => false,
            'is_recurrent' => false,
            'attachments' => [],
            ...$data,
        ];
    }
}
