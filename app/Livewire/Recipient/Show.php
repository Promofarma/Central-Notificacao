<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use App\Models\NotificationRecipient;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    #[Locked]
    public string $notificationUuid;

    #[Locked]
    public int $recipientId;

    public ?NotificationRecipient $notificationRecipient;

    public function mount(): void
    {
        $this->initializeNotificationRecipient();
    }

    public function getNotificationRecipient(): NotificationRecipient
    {
        return NotificationRecipient::query()
            ->select(['id', 'notification_uuid', 'recipient_id', 'readed_at', 'archived_at', 'created_at'])
            ->with([
                'notification' => fn ($query) => $query
                        ->select(['uuid', 'title', 'content', 'user_id', 'created_at'])
                        ->with([
                            'user' => fn ($query) => $query->select(['id', 'name']),
                            'attachments' => fn ($query) => $query->select(['id', 'file_name', 'size', 'extension', 'path', 'notification_uuid', 'created_at']),
                        ]),
            ])
            ->where([
                'notification_uuid' => $this->notificationUuid,
                'recipient_id' => $this->recipientId,
            ])
            ->firstOrFail();
    }

    #[On('notification-archived')]
    public function onNotificationArchived(): void
    {
        Cache::put($this->getCacheKey(), $this->notificationRecipient);
    }

    public function render(): View|Factory
    {
        return view('livewire.recipient.show', [
            'notificationRecipient' => $this->notificationRecipient,
            'notification' => $this->notificationRecipient->notification,
        ]);
    }

    private function initializeNotificationRecipient(): void
    {
        /** @var NotificationRecipient $notificationRecipient */
        $notificationRecipient = Cache::get($this->getCacheKey()) ?? $this->getNotificationRecipient();

        if (! $notificationRecipient->isRead()) {
            $notificationRecipient->markAsRead();

            $this->dispatch('notification-readed');

            Cache::put($this->getCacheKey(), $notificationRecipient);
        }

        $this->notificationRecipient = $notificationRecipient;
    }

    private function getCacheKey(): string
    {
        return 'recipient.'.$this->recipientId.'.notification.'.$this->notificationUuid;
    }
}
