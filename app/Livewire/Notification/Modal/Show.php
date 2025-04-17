<?php declare(strict_types=1);

namespace App\Livewire\Notification\Modal;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Livewire\Ui\Modal\Modal;
use App\Models\Notification;
use Livewire\Attributes\Locked;

final class Show extends Modal
{
    #[Locked]
    public ?Notification $notification = null;

    public function open(?Notification $notification = null): void
    {
        parent::open();

        $this->notification = $notification->load(['recipients.recipient', 'attachments', 'schedule.results']);
    }

    public function render(): Factory|View
    {
        return view('livewire.notification.modal.show');
    }
}
