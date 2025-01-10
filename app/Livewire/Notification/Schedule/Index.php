<?php

declare(strict_types=1);

namespace App\Livewire\Notification\Schedule;

use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

class Index extends Component
{
    public Collection $results;

    #[On('notification-schedule-cancelled')]
    public function render(): View|Factory
    {
        return view('livewire.notification.schedule.index');
    }
}
