<?php

declare(strict_types=1);

namespace App\Livewire\Notification;

use App\DTO\NotificationDTO;
use App\Events\NotificationReady;
use App\Livewire\Component\Pages\BaseCreatePage;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

final class Create extends BaseCreatePage
{
    protected static string $view = 'livewire.notification.create';

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        if ($data['is_recurrent'] && (Carbon::parse($data['recurrence']['start_date'])->isToday())) {
            $data['scheduled_date'] = $data['recurrence']['start_date'];
            $data['scheduled_time'] = $data['recurrence']['scheduled_time'];
        }

        return NotificationDTO::fromArray($data)->toArray();
    }

    protected function afterCreate(): void
    {
        event(new NotificationReady($this->getRecord(), $this->data));
    }

    public function getModel(): Model
    {
        return new Notification;
    }
}
