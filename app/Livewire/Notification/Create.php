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
        if ($data['recurrent_send']) {
            $data['scheduled_at'] = $data['recurrence']['start_date'] !== now()->format('Y-m-d') ? $data['recurrence']['start_date'] : null;
        }

        return NotificationDTO::fromArray($data)->toArray();
    }

    protected function afterCreate(): void
    {
        (new BindNotificationRecipients())->handle(
            notification: $this->record,
            recipientIds: $this->getRecipientIdsBasedOnSelection()
        );

        (new BindNotificationAttachments())->handle(
            notification: $this->record,
            attachments: $this->data['attachments']
        );

        if ($this->data['recurrent_send']) {
            (new CreateNotificationSchedule())->handle(
                notification: $this->record,
                data: $this->data['recurrence']
            );
        }

        Toast::success(title: 'Notificação Criada com Sucesso!')->now();

        ForgetCacheManyKeys::make(
            key: 'notification_recipient:*',
            values: $this->getRecipientIdsBasedOnSelection(),
        )->forgetAll();

        $this->redirectRoute($this->routeName('index'));
    }

    protected function getFormSchema(): array
    {
        return NotificationFormSchema::get();
    }

    private function getRecipientIdsBasedOnSelection(): array
    {
        return $this->data['all_recipients'] ? Recipient::pluck('id')->toArray() : $this->data['recipient_ids'];
    }
}
