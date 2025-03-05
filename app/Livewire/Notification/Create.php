<?php

declare(strict_types=1);

namespace App\Livewire\Notification;

use App\Actions\BindNotificationAttachments;
use App\Actions\BindNotificationRecipients;
use App\Actions\CreateNotificationSchedule;
use App\DTO\NotificationDTO;
use App\Forms\Schemas\NotificationFormSchema;
use App\Helpers\ForgetCacheManyKeys;
use App\Livewire\Ui\Page\Create as PageCreate;
use App\Livewire\Ui\Toast\Toast;
use App\Models\Notification;
use App\Models\Recipient;
use Illuminate\Support\Carbon;

class Create extends PageCreate
{
    protected static string $layout = 'components.layouts.app';

    protected static string $view = 'livewire.notification.create';

    protected function getModel(): string
    {
        return Notification::class;
    }

    protected function prepareDataForCreate(array $data): array
    {
        if ($data['is_recurrent'] && (Carbon::parse($data['recurrence']['start_date'])->isToday())) {
            $data['scheduled_date'] = $data['recurrence']['start_date'];
            $data['scheduled_time'] = $data['recurrence']['scheduled_time'];
        }

        return NotificationDTO::fromArray($data)->toArray();
    }

    protected function afterCreate(): void
    {
        $this->bindRecipients();

        $this->bindAttachments();

        $this->resolveRecurrentSend();

        Toast::success(
            title: 'Tudo certo!',
            body:'Sua notificação foi criada com sucesso. 🎉'
        )->now();

        $this->redirectRoute($this->routeName('index'));
    }

    protected function getFormSchema(): array
    {
        return NotificationFormSchema::get();
    }

    private function bindRecipients(): void
    {
        $recipientIds = $this->data['send_to_all_recipients']
            ? Recipient::pluck('id')->toArray()
            : $this->data['recipient_ids'];

        (new BindNotificationRecipients())->handle($this->record, $recipientIds);

        ForgetCacheManyKeys::make('notification_recipient:*', $recipientIds)->forgetAll();
    }

    private function bindAttachments(): void
    {
        (new BindNotificationAttachments())->handle($this->record, $this->data['attachments']);
    }

    private function resolveRecurrentSend(): void
    {
        if (! $this->data['is_recurrent']) {
            return;
        }

        (new CreateNotificationSchedule())->handle($this->record, $this->data['recurrence']);
    }
}
