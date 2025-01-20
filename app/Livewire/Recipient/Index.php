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
use Livewire\Attributes\On;

class Index extends Page
{
    use InteractsWithFilterData;

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'livewire.recipient.index';

    protected static ?string $title = 'Caixa de entrada';

    #[Locked]
    /** Route parameter */
    public int $recipientId;

    /** Selected notification uuid */
    public ?string $selected = null;

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
                'notification' => fn ($query) => $query
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
                            'user' => fn ($query) => $query->select([
                                'id',
                                'name',
                            ]),
                            'category' => fn ($query) => $query->select([
                                'id',
                                'name',
                            ]),
                        ]),
            ])
            ->where('recipient_id', $this->recipientId)
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

    #[On('notification-read', 'notification-archived')]
    public function forgetCacheOnNotificationEvent(): void
    {
        $this->forgetCache();
    }

    public function afterOnFilterDataUpdated(): void
    {
        $this->forgetCache();
    }

    public function afterOnFilterDataReseted(): void
    {
        $this->forgetCache();
    }

    protected function getViewData(): array
    {
        return [
            'groupedRecipientNotifications' => $this->getGroupedRecipientNotifications(),
        ];
    }

    private function forgetCache(): void
    {
        Cache::forget($this->getCacheKey());
    }

    private function getCacheKey(): string
    {
        return 'recipient.' . $this->recipientId . '.notifications';
    }
}
