<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use App\Models\NotificationRecipient;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Show extends Component
{
    #[Locked]
    public int $recipientId;

    #[Locked]
    public string $notificationUuid;

    public NotificationRecipient $notificationRecipient;

    public function mount(): void
    {
        $this->notificationRecipient = Cache::get($this->getCacheKey()) ?? $this->getNotificationRecipientFromDatabase();

        if (!$this->notificationRecipient->isRead()) {
            $this->notificationRecipient->markAsRead();
            $this->updateNotificationCache();
            $this->dispatch('notification-readed');
        }
    }

    public function render(): View|Factory
    {
        return view('livewire.recipient.show', [
            'notificationRecipient' => $this->notificationRecipient,
            'notification' => $this->notificationRecipient->notification,
        ]);
    }

    private function updateNotificationCache(): void
    {
        Cache::put(
            $this->getCacheKey(),
            $this->notificationRecipient,
        );
    }

    private function getNotificationRecipientFromDatabase(): NotificationRecipient
    {
        return NotificationRecipient::query()
            ->select(['id', 'notification_uuid', 'recipient_id', 'read_at', 'archived_at', 'created_at'])
            ->with([
                'notification' => static fn ($query) => $query
                    ->select(['uuid', 'title', 'content', 'category_id', 'user_id', 'created_at'])
                    ->with(['user', 'attachments']),
            ])
            ->where([
                'recipient_id' => $this->recipientId,
                'notification_uuid' => $this->notificationUuid,
            ])
            ->firstOrFail();
    }

    private function getCacheKey(): string
    {
        return sprintf(
            'recipient-%d-notification-%s',
            $this->recipientId,
            $this->notificationUuid
        );
    }
}
