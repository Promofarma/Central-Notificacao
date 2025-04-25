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

/**
 * @property NotificationRecipient $notificationRecipient
 */
final class Show extends Component
{
    #[Locked]
    public int $id;

    #[Locked]
    public string $uuid;

    public ?NotificationRecipient $notificationRecipient = null;

    public function mount(): void
    {
        $this->initialize();
    }

    #[On('notification-archived')]
    public function handleNotificationArchived(): void
    {
        $cacheKey = $this->getCacheKey();

        Cache::forget($cacheKey);

        $notificationRecipient = $this->fetchNotificationRecipient();

        Cache::put($cacheKey, $notificationRecipient, now()->addMinutes(5));

        $this->notificationRecipient = $notificationRecipient;
    }

    public function fetchNotificationRecipient(): NotificationRecipient
    {
        return Cache::rememberForever($this->getCacheKey(), fn (): NotificationRecipient => NotificationRecipient::query()
            ->select([
                'id',
                'recipient_id',
                'notification_uuid',
                'viewed_at',
                'readed_at',
                'archived_at',
                'created_at',
            ])
            ->with(['notification' => function ($query) {
                $query
                    ->select([
                        'uuid',
                        'title',
                        'content',
                        'user_id',
                        'category_id',
                        'created_at',
                    ])
                    ->with([
                        'user:id,name,email',
                        'attachments:id,file_name,size,extension,path,notification_uuid,created_at',
                    ]);
            }])
            ->where([
                'recipient_id' => $this->id,
                'notification_uuid' => $this->uuid,
            ])
            ->firstOrFail()
        );
    }

    public function render(): Factory|View
    {
        return view('livewire.recipient.show', [
            'recipient' => $this->notificationRecipient,
            'notification' => $this->notificationRecipient->notification,
        ]);
    }

    private function initialize(): void
    {
        $cacheKey = $this->getCacheKey();

        /** @var ?NotificationRecipient $notificationRecipient */
        $notificationRecipient = Cache::get($cacheKey);

        if ($notificationRecipient) {
            $this->notificationRecipient = $notificationRecipient;

            return;
        }

        $notificationRecipient = $this->fetchNotificationRecipient();

        if (! $notificationRecipient->isRead()) {
            $notificationRecipient->markAsRead();

            $this->dispatch('notification-read');

            Cache::put($cacheKey, $notificationRecipient, now()->addMinutes(5));
        }

        $this->notificationRecipient = $notificationRecipient;
    }

    private function getCacheKey(): string
    {
        return sprintf('notification-recipient:%s:%s', $this->id, $this->uuid);
    }
}
