<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Actions\GenerateDailyNotifications;
use App\Actions\GenerateMonthlyNotifications;
use App\Actions\GenerateWeeklyNotifications;
use App\Models\NotificationSchedule;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessScheduledNotifications implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public NotificationSchedule $schedule
    ) {
    }

    public function handle(): void
    {
        match ($this->schedule->interval) {
            'daily' => (new GenerateDailyNotifications())->handle($this->schedule),
            'weekly' => (new GenerateWeeklyNotifications())->handle($this->schedule),
            'monthly' => (new GenerateMonthlyNotifications())->handle($this->schedule),
        };
    }
}
