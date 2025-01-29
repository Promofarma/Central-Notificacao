<?php

declare(strict_types=1);

namespace App\Livewire\Notification;

use App\Filters\Concerns\InteractsWithFilterData;
use App\Filters\NotificationFilter;
use App\Livewire\Ui\Page\Index as PageIndex;
use App\Livewire\Ui\Toast\Toast;
use App\Models\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;

class Index extends PageIndex
{
    use InteractsWithFilterData;

    protected static string $view = 'livewire.notification.index';

    protected static ?string $title = 'Notificações';

    #[Computed]
    public function notifications(): Collection
    {
        return Notification::query()
            ->with('schedule')
            ->withCount([
                'recipients',
                'recipients as recipients_read_count' => fn ($query) => $query->read(),
                'attachments',
            ])
            ->where('user_id', Auth::id())
            ->whereNull('parent_uuid')
            ->orderBy('created_at', 'desc')
            ->filter(new NotificationFilter($this->getFilterData()))
            ->get();
    }
}
