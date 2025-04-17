<?php

declare(strict_types=1);

namespace App\Livewire\Notification\Schedule;

use App\Models\NotificationSchedule;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

final class Index extends Component
{
    public NotificationSchedule $schedule;

    #[On('notification-schedule-cancelled')]
    public function render(): View|Factory
    {
        return view('livewire.notification.schedule.index');
    }
}
