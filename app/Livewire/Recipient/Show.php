<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use App\Helpers\InteractsWithCacheTags;
use App\Models\NotificationRecipient;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * @property NotificationRecipient $notificationRecipient
 */
final class Show extends Component
{
    use InteractsWithCacheTags;

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
        $cache = $this->getCacheTags();

        $cacheKey = $this->getCacheKey();

        if (! $cache->has($cacheKey)) {
            return;
        }

        $cache->forget($cacheKey);

        $notificationRecipient = $this->fetchNotificationRecipient();

        $cache->put($cacheKey, $notificationRecipient, now()->addMinutes(30));

        $this->notificationRecipient = $notificationRecipient;
    }

    public function fetchNotificationRecipient(): NotificationRecipient
    {
        return NotificationRecipient::query()
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
            ->firstOrFail();
    }

    public function render(): Factory|View
    {
        return view('livewire.recipient.show', [
            'recipient' => $this->notificationRecipient,
            'notification' => $this->notificationRecipient->notification,
        ]);
    }

    protected function getTags(): array
    {
        return [
            'recipient:'.$this->id,
            'notification:'.$this->uuid,
        ];
    }

    private function initialize(): void
    {
        $cache = $this->getCacheTags();

        /** @var ?NotificationRecipient $notificationRecipient */
        $notificationRecipient = $cache->get($this->getCacheKey());

        if ($notificationRecipient) {
            $this->notificationRecipient = $notificationRecipient;

            return;
        }

        try {
            $notificationRecipient = $this->fetchNotificationRecipient();

            if (! $notificationRecipient->isRead()) {
                $notificationRecipient->markAsRead();

                $this->dispatch('notification-read');

                $cache->put($this->getCacheKey(), $notificationRecipient, now()->addMinutes(30));
            }

            $this->notificationRecipient = $notificationRecipient;
        } catch (ModelNotFoundException) {
            abort(404);
        }
    }

    private function getCacheKey(): string
    {
        return sprintf('recipient:%s:notification:%s', $this->id, $this->uuid);
    }
}
