<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use App\Filters\Concerns\InteractsWithFilterData;
use App\Filters\NotificationRecipientFilter;
use App\Livewire\Ui\Page\Page;
use App\Models\Category;
use App\Models\NotificationRecipient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;

class Index extends Page
{
    use InteractsWithFilterData;

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'livewire.recipient.index';

    protected static ?string $title = 'Caixa de entrada';

    #[Locked]
    public int $recipientId;

    public ?string $selected = null;

    public function getNotificationRecipientItems(): Collection
    {
        return Cache::rememberForever(
            key: $this->getCacheKey(),
            callback: fn (): Collection => NotificationRecipient::query()->select([
                'id',
                'notification_uuid',
                'recipient_id',
                'viewed_at',
                'readed_at',
                'archived_at',
                'created_at',
            ])
            ->with([
                'notification' => fn ($query) => $query->select([
                    'uuid',
                    'title',
                    'content',
                    'category_id',
                    'scheduled_date',
                    'user_id',
                    'created_at',
                ])
                    ->with([
                        'user' => fn ($query) => $query->select(['id', 'name']),
                        'category' => fn ($query) => $query->select(['id', 'name']),
                    ])
                    ->withCount('attachments'),
            ])
            ->where('recipient_id', $this->recipientId)
            ->whereHas('notification', fn ($query) => $query->scheduled())
            ->filter(new NotificationRecipientFilter($this->getFilterData()))
            ->orderBy('created_at', 'desc')
            ->get(),
        );
    }

    public function getUnarchivedNotificationRecipients(): Collection
    {
        $unarchivedNotificationRecipients = $this->getNotificationRecipientItems()
            ->reject(fn (NotificationRecipient $notificationRecipient): bool => $notificationRecipient->archived_at !== null);

        return $this->groupNotificationRecipientItemsByCategoryName($unarchivedNotificationRecipients);
    }

    public function getArchivedNotificationRecipients(): Collection
    {
        $archivedNotificationRecipients = $this->getNotificationRecipientItems()
            ->filter(fn (NotificationRecipient $notificationRecipient): bool => $notificationRecipient->archived_at !== null);

        return $this->groupNotificationRecipientItemsByCategoryName($archivedNotificationRecipients);
    }

    #[On('notification-readed')]
    #[On('notification-archived')]
    public function forgetCache(): void
    {
        Cache::forget($this->getCacheKey());
    }

    public function afterOnFilterDataReseted(): void
    {
        $this->forgetCache();
    }

    public function afterOnFilterDataUpdated(): void
    {
        $this->forgetCache();
    }

    private function groupNotificationRecipientItemsByCategoryName(Collection $notificationRecipientItems): Collection
    {
        return $notificationRecipientItems->groupBy('notification.category.name')
            ->sortByDesc(fn (Collection $notificationRecipientItems): int => $notificationRecipientItems->count());
    }

    private function getCacheKey(): string
    {
        return sprintf('notification_recipient:%d', $this->recipientId);
    }

    protected function getViewData(): array
    {
        return [
            'unarchivedNotificationRecipients' => $this->getUnarchivedNotificationRecipients(),
            'archivedNotificationRecipients' => $this->getArchivedNotificationRecipients(),
            'categories' => Category::withCount([
                'notifications as notifications_unread_count' => fn ($query) => $query->whereHas('recipients', fn ($query) => $query->unread()->where('recipient_id', $this->recipientId)),
            ])->get(),
        ];
    }
}
