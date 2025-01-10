<?php

declare(strict_types=1);

namespace App\View\Components\Notification\Schedule;

use App\Models\NotificationScheduleResult;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusMessage extends Component
{
    public function __construct(
        public NotificationScheduleResult $result
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.notification.schedule.status-message');
    }
}
