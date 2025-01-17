<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use App\Filters\Concerns\InteractsWithFilterData;
use App\Filters\NotificationRecipientFilter;
use App\Livewire\Ui\Page\Page;
use App\Models\NotificationRecipient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Locked;

class Index extends Page
{
    use InteractsWithFilterData;

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'livewire.recipient.index';

    protected static ?string $title = 'Inbox';

    #[Locked]
    public int $recipient;

    public ?string $selectedNotificationUuid = null;

    public function getNotificationRecipients(): Collection
    {
        return NotificationRecipient::query()
            ->select([
                'id',
                'notification_uuid',
                'recipient_id',
                'read_at',
                'archived_at',
                'created_at',
            ])
            ->with([
                'notification' => static fn ($query) => $query
                        ->select([
                            'uuid',
                            'title',
                            'content',
                            'category_id',
                            'user_id',
                            'created_at',
                        ])
                        ->withCount('attachments')
                        ->with([
                            'category:id,name',
                            'user:id,name',
                        ]),
            ])
            ->where('recipient_id', $this->recipient)
            ->filter(new NotificationRecipientFilter($this->getFilterData()))
            ->get();
    }

    public function getGroupedRecipientNotifications(): Collection
    {
        return Cache::rememberForever(
            $this->getCacheKey(),
            fn (): Collection => $this
                ->getNotificationRecipients()
                ->groupBy('notification.category.name')
                ->sortByDesc(fn (Collection $group): int => $group->count())
        );
    }

    private function getCacheKey(): string
    {
        return 'recipient-' . $this->recipient . '-notifications';
    }

    protected function afterOnFilterDataUpdated(): void
    {
        Cache::forget($this->getCacheKey());
    }

    protected function afterOnFilterDataReseted(): void
    {
        Cache::forget($this->getCacheKey());
    }

    protected function getViewData(): array
    {
        return [
            'groupedRecipientNotifications' => $this->getGroupedRecipientNotifications(),
        ];
    }
}
