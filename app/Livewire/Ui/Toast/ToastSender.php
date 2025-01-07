<?php

declare(strict_types=1);

namespace App\Livewire\Ui\Toast;

use Filament\Notifications\Notification;

class ToastSender
{
    public function __construct(
        protected Notification $notification
    ) {
    }

    public function now(): void
    {
        $this->notification->send();
    }

    public function toDatabase($users): void
    {
        $this->notification->sendToDatabase($users);
    }
}
