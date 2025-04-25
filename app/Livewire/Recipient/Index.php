<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use App\Filters\Concerns\InteractsWithFilterData;
use App\Filters\NotificationRecipientFilter;
use App\Helpers\InteractsWithCacheTags;
use App\Livewire\Component\Pages\BasePage;
use App\Models\Category;
use App\Models\NotificationRecipient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

final class Index extends BasePage
{
    use InteractsWithCacheTags;
    use InteractsWithFilterData;

    #[Locked]
    public int $recipient;

    #[Url]
    public string $tab = 'inbox';

    #[Url(as: 'category')]
    public ?int $category = null;

    #[Url(as: 'notification')]
    public ?string $notification = null;

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'livewire.recipient.index';

    public function updatedTab(): void
    {
        $this->reset('category');
    }

    #[Computed]
    public function categories(): Collection
    {
        return Category::query()
            ->select([
                'id',
                'name',
            ])
            ->withCount([
                'notifications' => fn ($query) => $query->whereHas('recipients', fn ($query): Builder => $this->applyFilters($query)),
            ])
            ->whereHas('notifications.recipients', fn ($query): Builder => $this->applyFilters($query))
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    public function notificationRecipients(): Collection
    {
        return $this->getCacheTags()->remember($this->getCacheKey(), now()->addMinutes(30), function (): Collection {
            $query = NotificationRecipient::query()
                ->select([
                    'id',
                    'notification_uuid',
                    'recipient_id',
                    'viewed_at',
                    'readed_at',
                    'archived_at',
                    'created_at',
                ])
                ->with([
                    'notification' => fn ($query) => $query
                        ->select([
                            'uuid',
                            'title',
                            'content',
                            'user_id',
                            'scheduled_date',
                            'scheduled_time',
                            'category_id',
                            'created_at',
                        ])
                        ->with('user:id,name')
                        ->withCount('attachments')
                        ->where('category_id', $this->category),
                ])
                ->whereRelation('notification', 'category_id', $this->category);

            return $this->applyFilters($query)
                ->orderByDesc('created_at')
                ->get();
        });
    }

    #[On('notification-read')]
    public function handleNotificationRead(): void
    {
        $this->invalidateCache();
    }

    #[On('notification-archived')]
    public function handleNotificationArchived(): void
    {
        $this->invalidateCache();
    }

    public function afterFilterDataUpdated(): void
    {
        $this->invalidateCache();
    }

    protected function getTags(): array
    {
        return [
            'recipient:'.$this->recipient,
            'inbox',
        ];
    }

    private function applyFilters(Builder $query): Builder
    {
        return $query->filter(new NotificationRecipientFilter([
            'tab' => $this->tab,
            'recipient_id' => $this->recipient,
            ...$this->getFilterData(),
        ]));
    }

    private function getCacheKey(): string
    {
        return sprintf(
            'notification-recipients:%s:%s:%s',
            $this->recipient,
            $this->tab,
            $this->category ?? 'none',
            // md5(json_encode($this->getFilterData()))
        );
    }
}
