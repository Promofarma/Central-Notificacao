<?php

declare(strict_types=1);

namespace App\Actions;

use App\Helpers\GenerateNotifications;
use App\Models\NotificationSchedule;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final class GenerateWeeklyNotifications extends GenerateNotifications
{
    protected function filter(Collection $collection, NotificationSchedule $schedule): Collection
    {
        return $collection->filter(function (Carbon $date) use ($schedule): bool {
            $dayOfWeek = strtolower($date->format('l'));

            return in_array($dayOfWeek, $schedule->interval_days_of_week, true);
        });
    }
}
