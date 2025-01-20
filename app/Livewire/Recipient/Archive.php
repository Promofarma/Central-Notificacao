<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use App\Livewire\Ui\Toast\Toast;
use App\Models\NotificationRecipient;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Renderless;

class Archive extends Component
{
    public NotificationRecipient $notificationRecipient;

    public function archive(): void
    {
        try {
            $this->notificationRecipient->update(['archived_at' => now()]);

            $this->dispatch('notification-archived');

            Toast::success('Notificação arquivada com sucesso!')->now();
        } catch (QueryException $exception) {
            Toast::exception($exception)->now();
        }
    }

    #[Renderless]
    public function render(): View|Factory
    {
        return view('livewire.recipient.archive');
    }
}
