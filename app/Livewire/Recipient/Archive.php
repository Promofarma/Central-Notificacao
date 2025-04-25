<?php

declare(strict_types=1);

namespace App\Livewire\Recipient;

use App\Livewire\Ui\Toast\Toast;
use App\Models\NotificationRecipient;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Renderless;
use Livewire\Component;

final class Archive extends Component
{
    #[Locked]
    public NotificationRecipient $recipient;

    public function archive(): void
    {
        try {
            $this->recipient->update(['archived_at' => now()]);

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
