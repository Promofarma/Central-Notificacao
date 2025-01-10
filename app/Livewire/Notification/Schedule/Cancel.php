<?php

declare(strict_types=1);

namespace App\Livewire\Notification\Schedule;

use App\Enums\ScheduleResultStatus;
use App\Livewire\Ui\Toast\Toast;
use App\Models\NotificationScheduleResult;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Cancel extends Component
{
    public NotificationScheduleResult $result;

    public function cancel(): void
    {
        try {
            $this->result->update([
                'status' => ScheduleResultStatus::Cancelled,
                'canceled_at' => now(),
            ]);

            $this->dispatch('notification-schedule-cancelled');

            Toast::success('Agendamento cancelado com sucesso!')->now();
        } catch (QueryException $exception) {
            Toast::exception($exception)->now();
        }
    }

    public function render(): View|Factory
    {
        return view('livewire.notification.schedule.cancel');
    }
}
