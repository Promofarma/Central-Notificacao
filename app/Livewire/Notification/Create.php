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
    protected const DEFAULT_SCHEDULED_TIME = '07:00:00';

    protected static string $view = 'livewire.notification.create';

    public function getModel(): Model
    {
        return new Notification;
    }

    /**
     * Requested by @Isabella Nakano: (18/06/2025)
     * - When creating a recurrent or scheduled notification, set the time to "07:00";
     * - Removed "scheduled_time" from the notification form creation;
     *
     * @param array $data<string,mixed>
     * @return array
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->configureRecurrentNotificationSchedule($data);

        return NotificationDTO::fromArray($data)->toArray();
    }

    protected function afterCreate(): void
    {
        event(new NotificationReady(notification: $this->getRecord(), data: $this->data));
    }

    private function configureRecurrentNotificationSchedule(array &$data): void
    {
        /** @var bool $isRecurrent */
        $isRecurrent = $data['is_recurrent'];

        if (! $isRecurrent) {
            return;
        }

        $startDate = Carbon::parse($data['recurrence']['start_date']);

        if ($startDate->isToday()) {
            $data['scheduled_date'] = $startDate->format('Y-m-d');
        }
    }
}
